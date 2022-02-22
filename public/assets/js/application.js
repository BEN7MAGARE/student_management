(function () {
    
    $('#classID').on('change', function () {
        var id = $(this).val();
        if (id !== "") {
            $.getJSON('../classes/' + id).done(function (classe) {
                var qualification = classe.course.qualification;
                var dsc = "<div class=\"alert-primary\" style=\"padding:.8em;border-radius:15px;\"><h6><strong>Mminimum Mean Grade: </strong><span>" + qualification.mean_grade + "</span></h6><br><p>" + qualification.qualifications + "</p></div>";
                $("#courseDescription").html(dsc);
            });
        }
    });

})();