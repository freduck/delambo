const menu=document.querySelector('.menu');
let open=document.getElementById('open-menu');
open.addEventListener('click',function(e){
    e.stopPropagation();
    if(menu.classList.contains('hidden')){
        menu.classList.remove('hidden');
        menu.scrollIntoView({
            behavior:'smooth',
            block:'center'
        })
    }else{
        menu.classList.add('hidden');
    }
})