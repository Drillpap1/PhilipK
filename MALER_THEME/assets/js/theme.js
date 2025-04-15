/**
 * Theme.js - Allgemeine Theme-Funktionen
 * 
 * Enthält verschiedene Utility-Funktionen und Theme-spezifische Funktionalitäten
 * Verwendet modernes JavaScript (ES6+) mit:
 * - Performance-Optimierung
 * - Zugänglichkeit
 * - Best Practices
 */

/**
 * IIFE (Immediately Invoked Function Expression) für Namespace-Schutz
 * Verhindert globale Variablenkontamination
 */
(function() {
    'use strict';
    
    // DOM-Ready Check mit moderner Methode
    const ready = (callback) => {
        if (document.readyState !== 'loading') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    };
    
    /**
     * Lazy Loading für Bilder 
     * Verbessert Performance durch Laden nach Bedarf
     */
    const setupLazyLoading = () => {
        // Prüfen, ob der Browser native lazy-loading unterstützt
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy-loading für alle Bilder aktivieren
            const images = document.querySelectorAll('img[data-src]');
            images.forEach(img => {
                img.src = img.dataset.src;
                img.loading = 'lazy';
            });
        } else {
            // Fallback für Browser ohne native Unterstützung
            // Hier könnte eine Intersection Observer-Implementation folgen
        }
    };
    
    /**
     * Smooth Scroll zu Ankerpunkten
     * Verbessert UX mit sanften Übergängen
     */
    const setupSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    // Sanftes Scrollen zum Ziel mit Fallback
                    if ('scrollBehavior' in document.documentElement.style) {
                        // Moderner Ansatz mit CSS scroll-behavior
                        targetElement.scrollIntoView({ 
                            behavior: 'smooth',
                            block: 'start'
                        });
                    } else {
                        // Fallback für ältere Browser
                        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    };
    
    /**
     * Form-Validierung verbessern
     * Erweiterte Client-Validierung mit Feedback
     */
    const enhanceFormValidation = () => {
        const forms = document.querySelectorAll('.contact-form form, .wpcf7-form');
        
        forms.forEach(form => {
            // Inputs mit erforderlichen Attributen versehen
            const requiredInputs = form.querySelectorAll('input[required], textarea[required]');
            requiredInputs.forEach(input => {
                // ARIA-Attribute hinzufügen
                input.setAttribute('aria-required', 'true');
                
                // Validierungsfeedback anzeigen
                input.addEventListener('invalid', () => {
                    input.classList.add('invalid');
                });
                
                // Validierungsklasse entfernen, wenn Korrektur beginnt
                input.addEventListener('input', () => {
                    if (input.classList.contains('invalid')) {
                        input.classList.remove('invalid');
                    }
                });
            });
        });
    };
    
    /**
     * Initialization Function
     * Führt alle Setup-Funktionen aus
     */
    const init = () => {
        setupLazyLoading();
        setupSmoothScroll();
        enhanceFormValidation();
    };
    
    // DOM-Ready Aufruf
    ready(init);
    
    // Export für optionale externe Verwendung
    window.malerTheme = {
        init,
        setupLazyLoading,
        setupSmoothScroll,
        enhanceFormValidation
    };
})(); 