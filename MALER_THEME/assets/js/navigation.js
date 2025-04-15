/**
 * Navigation.js - Verantwortlich für die mobile Navigation
 * 
 * Verwendet moderne JavaScript-Standards (ES6+)
 * Enthält:
 * - Ordnungsgemäße Fehlerbehandlung
 * - Zugänglichkeit (ARIA-Attribute)
 * - Event-Delegation wo sinnvoll
 * - Performance-Optimierungen
 */

document.addEventListener('DOMContentLoaded', () => {
    // Elemente selektieren
    const menuToggle = document.querySelector('.menu-toggle');
    const closeMenu = document.querySelector('.close-menu');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
    
    // Überprüfen, ob alle notwendigen Elemente existieren
    if (!menuToggle || !closeMenu || !mobileOverlay) {
        console.warn('Navigation: Ein oder mehrere benötigte DOM-Elemente fehlen');
        return; // Vorzeitiges Beenden, wenn Elemente fehlen
    }

    // Zugänglichkeit verbessern
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.setAttribute('aria-controls', 'mobile-menu-overlay');
    
    // Toggle mobile menu - mit Animation und a11y
    const openMobileMenu = () => {
        // Display vor Animation setzen für korrekten Übergang
        mobileOverlay.style.display = 'block';
        
        // ARIA-Attribute aktualisieren
        menuToggle.setAttribute('aria-expanded', 'true');
        
        // requestAnimationFrame für bessere Performance bei Animationen
        requestAnimationFrame(() => {
            // Minimale Verzögerung für korrekte CSS-Transition
            setTimeout(() => {
                mobileOverlay.classList.add('active');
                menuToggle.classList.add('active');
                document.body.style.overflow = 'hidden'; // Scrolling verhindern
            }, 10);
        });
    };

    // Close mobile menu - mit Animation und a11y
    const closeMobileMenu = () => {
        // ARIA-Attribute aktualisieren
        menuToggle.setAttribute('aria-expanded', 'false');
        
        mobileOverlay.classList.remove('active');
        menuToggle.classList.remove('active');
        
        // Verzögert ausblenden, nachdem Übergang abgeschlossen ist
        setTimeout(() => {
            mobileOverlay.style.display = 'none';
            document.body.style.overflow = ''; // Scrolling wieder erlauben
        }, 300); // Dauer der CSS-Transition
    };

    // Event-Listener mit Error-Handling
    try {
        // Menü öffnen
        menuToggle.addEventListener('click', openMobileMenu);
        
        // Menü schließen
        closeMenu.addEventListener('click', closeMobileMenu);

        // Links verwalten mit Event-Delegation
        if (mobileMenuLinks.length > 0) {
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        }

        // Außerhalb klicken zum Schließen
        mobileOverlay.addEventListener('click', (e) => {
            if (e.target === mobileOverlay) {
                closeMobileMenu();
            }
        });

        // ESC-Taste zum Schließen
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileOverlay.classList.contains('active')) {
                closeMobileMenu();
            }
        });
    } catch (error) {
        console.error('Navigation: Fehler beim Initialisieren der Event-Listener', error);
    }
}); 