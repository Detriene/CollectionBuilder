    $(document).ready(function(){
        var question = 1;
        var errormessage = "";
        var scoremessage = "";
        var answer = "";
        var score = 0;

        show_question();

        function show_question(){
            $.ajax({
                url:'index.php/Quiz/getNextQuestion',
                method: 'POST',
                data: {},
                dataType:'json',
                success:function(data){
                    console.log(data);
                    $('#questionNum').html(question);
                    $('#question').html(data['Question']);
                    $('#a1').html(data['Answer1']);
                    $('#a2').html(data['Answer2']);
                    $('#a3').html(data['Answer3']);
                    $('#a4').html(data['Answer4']);
                    answer = data['CorrectAnswer'];
                    $('#currentScore').html(scoremessage);
                    $('#error').html(errormessage);
                }

            })
        }

        $('.answer').click(function(){
            question++;
            if (question != 1){
                if($(this).val() == answer){
                    score++;
                }
                else {
                    errormessage = "Wrong! Your Answer was " + $(this).val() + ". The Correct Answer was : " + answer;
                }
            }
            scoremessage = "Current Score " + score + "/" + (question - 1);
            show_question();

        })
    });