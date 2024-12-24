/**
 * Animated Stats JS.
 * @file
 */
(function (Drupal, drupalSettings) {
    /*
    * Animate Stats.
    */
    Drupal.behaviors.animateStat = {
        attach: function (context) {
 
          const elements = document.querySelectorAll('.stat_paragraph');
 
          elements.forEach(function(element) {
            const observer = new IntersectionObserver(entries => {
              if (entries[0].isIntersecting) {
                setTimeout(function() {
                  const counters = element.querySelectorAll('.stat_number');
                  const speed = 500;
                  
                  counters.forEach( counter => {
                    const animate = () => {
                        const value = +counter.getAttribute('value');
                        const data = +counter.innerText;
                      
                        const time = value / speed;
                        if (data < value) {
                          if (value > 999) {
                            counter.innerText = Math.ceil(data + time + 100);
                            setTimeout(animate, 1);
                          } else {
                            counter.innerText = Math.ceil(data + time);
                            setTimeout(animate, 1);
                          }
                        } else {
                          counter.innerText = value;
                        }
                    }
                    animate();
                  });
                }, 1000);
              }
            });
            observer.observe( element );
          });
 
          
 
        },
      };
  })(Drupal, drupalSettings);
