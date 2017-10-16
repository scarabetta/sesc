$(document).ready(function(){
    
    addVotes();

    $('.num-vote').on('change', function(){
        addVotes();
    });
});

function addVotes(){
    var total = 0;
    $('.num-vote').each(function(key, value){
        total += parseInt($(value).val());
    });

    $('#total-vote').text(total);   
}