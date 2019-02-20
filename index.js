document.addEventListener('click', function(e){
  if (e.target.name === 'voteOpt') {
    document.querySelector('.button').classList.add('active');
    var activeLi = document.querySelectorAll("li");
    activeLi.forEach(function(li){
      li.classList.remove('active')
    })
    e.target.parentElement.parentElement.classList.add('active')
  }
  if (e.target.id === 'close') {
    document.querySelector('.pollContent').classList.add('hidden')
  }
  if (e.target.id === 'close') {
    document.querySelector('.pollContent').classList.add('hidden')
  }
}, true);


(function($){
  $(document).ready(function(){
    $('[data-percentage]').each(function(){
      let percent = $(this).attr('data-percentage');
      $(this).animate({
        width : percent
      }, 1000);
    });
  });
})(jQuery)
