<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel Dependent Dropdown  Tutorial With Example</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="{{asset('js/jquery.js')}}"></script> 
  </head>
  <body>
    <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Select category and get bellow Related sub categgory</div>
          <div class="panel-body">
                <div class="form-group">
                    <label for="title">Select category:</label>
                    <select name="category" class="form-control" id="select-category" style="width:350px">
                        <option value="">--- Select category ---</option>
                        @foreach ($categories as  $cat)
                            <option value="{{ $cat->id}}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
               
          </div>
        </div>


       

    </div>
    
    

    
    <script type="text/javascript">
        var iteration = 0;
        var main_div = $('#select-category').parent().parent();
        
          

        $(document).ready(function() {
            $('#select-category').on('change', function() {
               
                var categoryid = $(this).val();
                var selection=0;
                if(categoryid) {
                  
                    display_ajax(selection,categoryid,main_div);
                }else{
                   
                    $('.select-category').empty();
                }
            });


            
        });
        function display_ajax(selection,categoryid,main_div){
           
            $.ajax({
                        url: '/category/ajax/'+categoryid,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            if(data.length > 0){
                           
                                html = '<div class="form-group">';
                                html += '<select class="form-control select-category" style="width:350px">';
                                html += '<option value="" disabled selected >select </option>';
                                $.each(data, function(key, value) {
                                    html += '<option value="'+ value.id +'">'+ value.category_name +'</option>';
                                });
                                html += '</select>';
                                html += '</div>';
                                main_div.append(html);
                                iteration++;
                               
                                var change_val=0;
                                $('.select-category').on('change', function() {
                                   
                                    var categoryid = $(this).val();
                                    var selection=1;
                                    if(categoryid) {
                                        display_ajax(selection,categoryid,main_div);
                                    }else{
                                        $('.form-group').last().remove();
                                    }
                                });
                            }else{
                            
                                

                                if(iteration > 0  && selection !=1){
                                  
                            //    alert($('.form-group').length );
                                  for(i=0;i<iteration;i++){
                                    $('.form-group').last().remove();

                                  }
                                        
                                    iteration--;

                                    
                                   
                                }
                                
                            }
                            
                        }
                    });
        }
    </script>
  </body>
</html>