(function() {
    function getCourses() {
        var option = "<option value=''>Select one</option>";
        $.getJSON('../courses-get').done(function(courses){
            $.each(courses, function(key,value){
                option += "<option value="+value.id+">"+value.name+"</option>";
                $("#courseID").html(option);
                $("#editcourseID").html(option);
            })
        });
    }
    getCourses();


    $('body').on('click', '#editClassDetails', function(){
        var class_id = $(this).data('id');
        $.getJSON('../classes/' + class_id).done(function (classe) {
            console.log(classe);
            $('#editClassID').val(classe.id);
            $('#editmode').val(classe.mode);
            $('#dp4').val(classe.start_date);
        });
    });
})();
