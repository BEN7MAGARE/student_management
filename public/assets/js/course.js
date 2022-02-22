(function() {
    $('body').on('click', '#editCourseDetails', function(){
        var course_id = $(this).data('id');
        $.getJSON('../courses/'+course_id).done(function(course){
            $('#editCourseID').val(course.id);
            $('#editname').val(course.name);
            $('#editYears').val(course.years);
            $('#editSemesters_per_year').val(course.semesters_per_year);
            $('#editmean_grade').val(course.qualification.mean_grade);
            $('#editqualifications').val(course.qualification.qualifications);
        });
    });
})();
