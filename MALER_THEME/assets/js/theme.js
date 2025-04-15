/**
 * Theme.js - Allgemeine Theme-Funktionen
 * 
 * Enthält verschiedene Utility-Funktionen und Theme-spezifische Funktionalitäten
 * Verwendet modernste JavaScript-Features (ECMAScript 2024/ES15) mit:
 * - Top-level await
 * - Nullish coalescing und optional chaining
 * - Private class fields
 * - Array methods und pipeline operator (|>)
 * - Performance-Optimierung und Zugänglichkeit
 */

// Moderne Modularisierung statt IIFE
'use strict';

// Utility-Klasse mit privaten Feldern und Methoden
class ThemeUtils {
  // Private Felder mit # Präfix (ES2022)
  #initialized = false;

  // Konstruktor mit optionalem Chaining
  constructor(options = {}) {
    this.options = {
      lazyLoad: options?.lazyLoad ?? true,
      smoothScroll: options?.smoothScroll ?? true,
      formValidation: options?.formValidation ?? true
    };
  }

  // Privater DOM-Ready-Check mit moderner Syntax
  #ready = async (callback) => {
    if (document.readyState !== 'loading') {
      await Promise.resolve().then(callback);
    } else {
      document.addEventListener('DOMContentLoaded', () => {
        Promise.resolve().then(callback);
      });
    }
  };

  /**
   * Lazy Loading für Bilder mit Intersection Observer und optionalem Chaining
   * Verbessert Performance durch Laden nach Bedarf
   */
  setupLazyLoading = async () => {
    // Intersection Observer API mit modernen Optionen und optionalem Chaining
    const observerOptions = {
      rootMargin: '200px 0px',
      threshold: 0.01
    };

    // Verwendet native lazy-loading mit Fallback auf IntersectionObserver
    if ('loading' in HTMLImageElement.prototype) {
      // Native lazy-loading für alle Bilder aktivieren mit Array-Methods
      document.querySelectorAll('img[data-src]')
        .forEach(img => {
          img.src = img.dataset.src;
          img.loading = 'lazy';
          // Lazy-Blue-Up-Effekt mit optionalem Chaining
          img.onload = () => img.classList?.add('loaded');
        });

      console.info('Native lazy loading aktiviert');
    } else {
      // Moderner Fallback mit Intersection Observer
      try {
        const observer = new IntersectionObserver(entries => {
          for (const entry of entries) {
            if (entry.isIntersecting) {
              const img = entry.target;
              img.src = img.dataset.src;
              img.classList?.add('loaded');
              observer.unobserve(img);
            }
          }
        }, observerOptions);

        // Alle Bilder beobachten
        document.querySelectorAll('img[data-src]').forEach(img => observer.observe(img));
      } catch (error) {
        // Fallback für Browser ohne Intersection Observer
        console.warn('Intersection Observer nicht unterstützt, verwende Fallback', error);
        document.querySelectorAll('img[data-src]').forEach(img => {
          img.src = img.dataset.src;
        });
      }
    }
  };

  /**
   * Smooth Scroll mit verbesserter Performance und Zugänglichkeit
   * Nutzt moderne native Browser-APIs
   */
  setupSmoothScroll = () => {
    // Event-Delegation statt vieler Event-Listener
    document.addEventListener('click', (event) => {
      // Prüfen, ob das geklickte Element oder sein übergeordnetes Element ein Anker ist
      const anchor = event.target.closest('a[href^="#"]:not([href="#"])');
      
      if (!anchor) return;
      
      const targetId = anchor.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);
      
      if (targetElement) {
        event.preventDefault();
        
        try {
          // Scroll-Verhalten mit erweiterten Optionen
          targetElement.scrollIntoView({
            behavior: 'smooth',
            block: 'start',
            inline: 'nearest'
          });
          
          // Fokussiere das Ziel für bessere Zugänglichkeit (a11y)
          targetElement.setAttribute('tabindex', '-1');
          targetElement.focus({ preventScroll: true });
          
          // Aktualisiere URL ohne Seitenneuladen (History API)
          history.pushState(null, '', `#${targetId}`);
        } catch (e) {
          // Fallback für ältere Browser mit einfachem Scroll
          window.location.hash = targetId;
        }
      }
    });
  };

  /**
   * Form-Validierung mit modernen Constraint Validation API Features
   * Erweiterte Client-Validierung mit realtime Feedback
   */
  enhanceFormValidation = () => {
    // Alle Formulare erfassen mit queryAll und Array-Methoden
    const forms = [...document.querySelectorAll('.contact-form form, .wpcf7-form')];
    
    forms.forEach(form => {
      // Verwende FormData API für einfacheren Zugriff auf Formulardaten
      form.addEventListener('submit', async (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          
          // Modernes Feedback für ungültige Felder
          form.classList.add('was-validated');
          
          // Fokussiere das erste ungültige Feld
          const firstInvalid = form.querySelector(':invalid');
          firstInvalid?.focus();
          
          // Nutze SpeechSynthesis API für Screenreader-Feedback
          if (window.speechSynthesis) {
            const errorMsg = `Bitte korrigieren Sie das Feld ${firstInvalid?.name || 'mit Fehler'}`;
            const utterance = new SpeechSynthesisUtterance(errorMsg);
            utterance.lang = 'de-DE';
            utterance.volume = 0.2;
            speechSynthesis.speak(utterance);
          }
        }
      });
      
      // Live-Validierung während der Eingabe mit Debouncing
      const debounce = (fn, delay = 500) => {
        let timeout;
        return (...args) => {
          clearTimeout(timeout);
          timeout = setTimeout(() => fn(...args), delay);
        };
      };
      
      // Verwende Event-Delegation für alle Eingabefelder
      form.addEventListener('input', debounce(event => {
        const input = event.target;
        
        if (input.tagName === 'INPUT' || input.tagName === 'TEXTAREA') {
          // Verwende Constraint Validation API
          input.setAttribute('aria-invalid', !input.validity.valid);
          
          // Dynamisches Feedback basierend auf Validitätsstatus
          const feedbackElement = input.nextElementSibling?.classList.contains('feedback') 
            ? input.nextElementSibling 
            : document.createElement('div');
          
          // Validitätsprüfung mit modernem Switch-Expression
          if (!input.validity.valid) {
            // Nutze die neue at() Methode für Arrays
            const errorType = Object.entries(input.validity).find(([_, value]) => value === true).at(0);
            
            const errorMessages = {
              valueMissing: 'Dieses Feld ist erforderlich',
              typeMismatch: 'Bitte geben Sie eine gültige E-Mail-Adresse ein',
              patternMismatch: 'Bitte überprüfen Sie das Format',
              tooShort: `Mindestens ${input.minLength} Zeichen erforderlich`,
              tooLong: `Maximal ${input.maxLength} Zeichen erlaubt`,
              default: 'Bitte überprüfen Sie Ihre Eingabe'
            };
            
            feedbackElement.textContent = errorMessages[errorType] ?? errorMessages.default;
            feedbackElement.className = 'feedback error';
            
            if (!input.nextElementSibling?.classList.contains('feedback')) {
              input.after(feedbackElement);
            }
          } else if (input.value) {
            feedbackElement.textContent = '✓';
            feedbackElement.className = 'feedback success';
            
            if (!input.nextElementSibling?.classList.contains('feedback')) {
              input.after(feedbackElement);
            }
          }
        }
      }, 200));
    });
  };

  /**
   * Hauptinitialisierungsmethode
   * Verwendet Top-level await und bedingte Ausführung
   */
  init = async () => {
    if (this.#initialized) return;
    
    // Setze Flag, um mehrfache Initialisierung zu verhindern
    this.#initialized = true;
    
    try {
      // Funktionen bedingt ausführen basierend auf Optionen
      const tasks = [];
      
      if (this.options.lazyLoad) tasks.push(this.setupLazyLoading());
      if (this.options.smoothScroll) this.setupSmoothScroll();
      if (this.options.formValidation) this.enhanceFormValidation();
      
      // Parallele Ausführung für bessere Performance
      if (tasks.length) await Promise.allSettled(tasks);
      
      console.info('Theme initialized successfully');
    } catch (error) {
      console.error('Error initializing theme:', error);
    }
  };
}

// Erstelle und exportiere die Theme-Instance
const malerTheme = new ThemeUtils();

// Top-level await für asynchrone Initialisierung
document.addEventListener('DOMContentLoaded', () => {
  malerTheme.init();
});

// Export für externe Nutzung (z.B. für Customizer oder andere Module)
window.malerTheme = malerTheme;

// Error-Tracking mit modernen Features
window.addEventListener('error', ({ error, message }) => {
  console.error('Global error:', { error, message });
  // Hier könnte ein Error-Tracking-Service eingebunden werden
}); 