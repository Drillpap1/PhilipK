/**
 * Navigation.js - Verantwortlich für die mobile Navigation
 * 
 * Implementiert mit ECMAScript 2024 (ES15) Features:
 * - Private Felder und Methoden
 * - Top-level await
 * - Strukturierte Fehlerbehandlung
 * - Nullish coalescing & optional chaining
 * - Focus management und Accessibility
 */

// Moderne Klasse für Navigation
class NavigationManager {
  // Private Felder für bessere Kapselung
  #menuToggle;
  #closeMenu;
  #mobileOverlay;
  #mobileMenuLinks;
  #initialized = false;
  #config;

  constructor(config = {}) {
    // Konfigurationsoptionen mit Nullish Coalescing
    this.#config = {
      menuToggleSelector: config.menuToggleSelector ?? '.menu-toggle',
      closeMenuSelector: config.closeMenuSelector ?? '.close-menu',
      overlaySelector: config.overlaySelector ?? '.mobile-menu-overlay',
      menuLinksSelector: config.menuLinksSelector ?? '.mobile-menu a',
      animationDuration: config.animationDuration ?? 300,
      debug: config.debug ?? false
    };
  }

  /**
   * Initialisiert die Navigation-Komponente
   * Verwendet Top-level await und verbesserte Fehlerbehandlung
   */
  async init() {
    if (this.#initialized) return;

    try {
      // DOM-Elemente selektieren mit modernen Selektoren
      this.#menuToggle = document.querySelector(this.#config.menuToggleSelector);
      this.#closeMenu = document.querySelector(this.#config.closeMenuSelector);
      this.#mobileOverlay = document.querySelector(this.#config.overlaySelector);
      this.#mobileMenuLinks = [...document.querySelectorAll(this.#config.menuLinksSelector)];

      // Überprüfen, ob erforderliche Elemente vorhanden sind
      if (!this.#menuToggle || !this.#closeMenu || !this.#mobileOverlay) {
        throw new Error('Erforderliche DOM-Elemente für die Navigation fehlen');
      }

      // A11y-Verbesserungen
      this.#setupAccessibility();
      
      // Event-Listener mit verbesserten Features
      this.#setupEventListeners();
      
      // Medienfragen für Responsive Design
      this.#setupMediaQueryListeners();

      this.#initialized = true;
      this.#log('Navigation erfolgreich initialisiert');
    } catch (error) {
      console.error('Fehler bei der Initialisierung der Navigation:', error);
      // Füge Fehlermeldung ins DOM ein, falls Debug-Modus aktiviert
      if (this.#config.debug) {
        const errorElement = document.createElement('div');
        errorElement.className = 'navigation-error';
        errorElement.setAttribute('role', 'alert');
        errorElement.innerHTML = `<strong>Navigation-Fehler:</strong> ${error.message}`;
        document.body.prepend(errorElement);
      }
    }
  }

  // Private Methode zur Verbesserung der Zugänglichkeit
  #setupAccessibility() {
    // ARIA-Attribute für bessere Zugänglichkeit
    this.#menuToggle.setAttribute('aria-expanded', 'false');
    this.#menuToggle.setAttribute('aria-controls', 'mobile-menu-overlay');
    this.#menuToggle.setAttribute('aria-label', 'Menü öffnen');
    
    this.#closeMenu.setAttribute('aria-label', 'Menü schließen');
    
    // ID für ARIA-controls falls nicht vorhanden
    if (!this.#mobileOverlay.id) {
      this.#mobileOverlay.id = 'mobile-menu-overlay';
    }
    
    this.#mobileOverlay.setAttribute('role', 'dialog');
    this.#mobileOverlay.setAttribute('aria-modal', 'true');
    this.#mobileOverlay.setAttribute('aria-label', 'Mobiles Navigationsmenü');

    // Fokus-Management
    const firstItem = this.#mobileMenuLinks.at(0);
    const lastItem = this.#mobileMenuLinks.at(-1);
    
    if (firstItem) firstItem.setAttribute('data-first-focusable', '');
    if (lastItem) lastItem.setAttribute('data-last-focusable', '');
  }

  // Private Methode für Event-Listener
  #setupEventListeners() {
    // Menü öffnen und fokusverwalten
    this.#menuToggle.addEventListener('click', this.#openMobileMenu.bind(this));
    
    // Menü schließen (mehrere Wege)
    this.#closeMenu.addEventListener('click', this.#closeMobileMenu.bind(this));
    
    // Links verwalten mit Event-Delegation für bessere Performance
    this.#mobileOverlay.addEventListener('click', (e) => {
      // Überprüfen, ob das Overlay direkt oder ein Link geklickt wurde
      if (e.target === this.#mobileOverlay) {
        this.#closeMobileMenu();
      } else if (e.target.closest('a[href]')) {
        this.#closeMobileMenu();
      }
    });

    // Tastaturnavigation verbessern
    document.addEventListener('keydown', (e) => {
      if (!this.#mobileOverlay.classList.contains('active')) return;
      
      switch (e.key) {
        case 'Escape':
          e.preventDefault();
          this.#closeMobileMenu();
          break;
        
        case 'Tab':
          // Verbesserte Fokus-Loop für Tastaturbenutzer
          const firstFocusable = this.#mobileOverlay.querySelector('[data-first-focusable]');
          const lastFocusable = this.#mobileOverlay.querySelector('[data-last-focusable]');
          
          if (e.shiftKey && document.activeElement === firstFocusable) {
            e.preventDefault();
            lastFocusable?.focus();
          } else if (!e.shiftKey && document.activeElement === lastFocusable) {
            e.preventDefault();
            firstFocusable?.focus();
          }
          break;
      }
    });
  }

  // Private Methode für Responsive Design
  #setupMediaQueryListeners() {
    // MediaQueryList für responsive Design mit Window-Resizing
    const mediaQuery = window.matchMedia('(min-width: 1200px)');
    
    // Handler für Medienabfrage mit moderner Callback-Struktur
    const handleMediaChange = (e) => {
      if (e.matches && this.#mobileOverlay.classList.contains('active')) {
        // Automatisches Schließen des mobilen Menüs bei Umschaltung auf Desktop-Ansicht
        this.#closeMobileMenu();
      }
    };
    
    // Überwache Änderungen an der Medienabfrage
    mediaQuery.addEventListener('change', handleMediaChange);
    
    // Initiale Prüfung
    handleMediaChange(mediaQuery);
  }

  // Menü öffnen mit Animation und Fokusmanagement
  #openMobileMenu() {
    this.#log('Öffne mobiles Menü');
    
    // Prärendering-Optimierungen
    requestAnimationFrame(() => {
      // Stelle sicher, dass das Overlay sichtbar ist, bevor Animationen starten
      this.#mobileOverlay.style.display = 'block';
      
      // Layout-Thrashing vermeiden durch Ausführen aller DOM-Lesevorgänge vor Schreibvorgängen
      const previouslyFocused = document.activeElement;
      
      // DOM-Schreibvorgänge gruppieren
      requestAnimationFrame(() => {
        // ARIA-Attribute aktualisieren
        this.#menuToggle.setAttribute('aria-expanded', 'true');
        this.#mobileOverlay.setAttribute('aria-hidden', 'false');
        
        // Aktiviere mit minimaler Verzögerung für korrekte Transition
        setTimeout(() => {
          this.#mobileOverlay.classList.add('active');
          this.#menuToggle.classList.add('active');
          document.body.style.overflow = 'hidden'; // Verhindere Hintergrund-Scrolling
          
          // Speichere vorherigen Fokus für späteren Zugriff
          this.#mobileOverlay.dataset.returnFocus = document.activeElement ? 
            (document.activeElement.id || 'menu-toggle') : 'menu-toggle';
          
          // Fokussiere ersten Link im Menü
          this.#mobileMenuLinks.at(0)?.focus();
        }, 10);
      });
    });
  }

  // Menü schließen mit Animation und Fokus zurücksetzen
  #closeMobileMenu() {
    this.#log('Schließe mobiles Menü');
    
    // ARIA-Attribute aktualisieren
    this.#menuToggle.setAttribute('aria-expanded', 'false');
    this.#mobileOverlay.setAttribute('aria-hidden', 'true');
    
    // Entferne Klassen für Animation
    this.#mobileOverlay.classList.remove('active');
    this.#menuToggle.classList.remove('active');
    
    // Verzögert ausblenden nach Animation
    setTimeout(() => {
      this.#mobileOverlay.style.display = 'none';
      document.body.style.overflow = ''; // Scrolling wieder aktivieren
      
      // Fokus zurücksetzen
      const returnFocusId = this.#mobileOverlay.dataset.returnFocus;
      if (returnFocusId && returnFocusId !== 'menu-toggle') {
        document.getElementById(returnFocusId)?.focus();
      } else {
        this.#menuToggle?.focus();
      }
    }, this.#config.animationDuration);
  }

  // Privater Logger
  #log(message) {
    if (this.#config.debug) {
      console.log(`[Navigation] ${message}`);
    }
  }
}

// Erstellen und initialisieren der Navigation-Instance
const navigation = new NavigationManager({
  debug: false, // In Produktion auf false setzen
});

// Initialisieren beim DOM-Laden mit Top-level await
document.addEventListener('DOMContentLoaded', async () => {
  await navigation.init();
}); 