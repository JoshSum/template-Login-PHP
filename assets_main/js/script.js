$(document).ready(function(){
           
           
           

//       $('#keyword').on('keyup', function(){
//           $.get('activation.php?keyword=' + $('keyword').val(), function(data){
//               $('#container').html(data);
//           })
//       }) 
       
//    $('#keyword').on('keyup', function(){
//        $('#container').load('activation.php?keyword=' + $('#keyword').val());
//    })
//    });
//    
//    
//var table = $('#user-disable').DataTable();
        $('#keyword').on('keyup', function(){
            $('#container').load('activation.php?keyword=' + $('#keyword').val());
//            $.get('activation.php?keyword=' + $('keyword').val(), function(data){
//               $('#container').html(data);
//        }); 
});
});
