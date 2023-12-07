$(document).ready(()=>{
    $(".sign__image input").change(function(){
        // console.log($(this))
        var preview = $(this).parent().parent().find('img')
        // console.log('avatar input change!')
        // console.log(preview)
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // console.log('onload',e.target.result)
                preview.attr('src',e.target.result)
                preview.css('display','block')
            };

            reader.readAsDataURL(this.files[0]);
        }
    });
})