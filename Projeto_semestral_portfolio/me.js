

        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress');
            const scrollTop = document.getElementById('scrollTop');
            const form = document.getElementById('contactForm');
            
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const progress = entry.target;
                        const width = progress.getAttribute('data-width');
                        setTimeout(() => {
                            progress.style.width = width + '%';
                        }, 200);
                    }
                });
            }, observerOptions);
            
            progressBars.forEach(bar => observer.observe(bar));
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollTop.classList.add('visible');
                } else {
                    scrollTop.classList.remove('visible');
                }
            });
            
            scrollTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const nome = document.getElementById('nome').value;
                const email = document.getElementById('email').value;
                const assunto = document.getElementById('assunto').value;
                const mensagem = document.getElementById('mensagem').value;
                
                if (nome && email && assunto && mensagem) {
                    alert('Mensagem enviada com sucesso! Obrigada pelo contacto, ' + nome + '. Responderei em breve.');
                    form.reset();
                } else {
                    alert('Por favor, preencha todos os campos.');
                }
            });
        });
