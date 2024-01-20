{{-- <!-- Magnific Popup-->
<script src="{{asset('backend/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- lightbox init js-->
<script src="{{asset('backend/assets/js/pages/lightbox.init.js')}}"></script> --}}
{{-- show category in infor tab --}}
<script>
   $(".infor_tab input[type=checkbox]").change(function (e) {
       var $status;
       var $category_id = $(this).attr('data-category-id');
       if (e.target.checked) { //If the checkbox is checked
           $status = 1;

       } else {
           $status = null;
       }
       toggleShowInInforTab($category_id,$status ).done(function(response){
           if(response.message){
           toastr.success(response.message);
           };
       });

   });
   function toggleShowInInforTab($category_id, $status){
       return $.ajax({
           dataType: "json",
           url:'/admin/interface_customize/category/ajax_changed_infor_tab',
           data:{
               'category_id': $category_id,
               "status": $status
               }
       });
   };

</script>
{{-- show category in sidebar --}}
<script>
    $(".sidebar_widget input[type=checkbox]").change(function (e) {
        var $status;
        var $category_id = $(this).attr('data-category-id');
        if (e.target.checked) { //If the checkbox is checked
            $status = 1;

        } else {
            $status = null;
        }
        toggleShowInSidebarWidget($category_id,$status ).done(function(response){
            if(response.message){
            toastr.success(response.message);
            };
        });

    });
    function toggleShowInSidebarWidget($category_id, $status){
        return $.ajax({
            dataType: "json",
            url:'/admin/interface_customize/category/ajax_changed_sidebar_widget',
            data:{
                'category_id': $category_id,
                "status": $status
                }
        });
    };

 </script>
