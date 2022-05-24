/*$(document).ready(function () {
    //$('#messagesent').hide();
    $('#envoyer').click(function () {
        $('#messagesent').innerText = $('#messagewritten').value;
        $('#messagesent').show();
    })
});*/

function envoyer() {
    document.getElementById('messagesent').innerText=document.getElementById('messagewritten').value;
    document.getElementById('messagewritten').value="";
}

