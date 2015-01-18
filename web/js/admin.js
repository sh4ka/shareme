/**
 * Created by jesus on 18/01/15.
 */
$( document ).ready(function(){

    $('button.btn-ban-submission').on('click', function(){
        submissionId = $(this).data('submission-id');
       banSubmission(submissionId)
    });

    var banSubmission = function(submissionId){
        console.log(submissionId)
    }
});