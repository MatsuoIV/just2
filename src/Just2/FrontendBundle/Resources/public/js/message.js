$(function() {

    $('.tooltips').tooltip()
})


function readMessage(subject, body, id, estate) {
   readMessageAction(subject, body, id, estate,'../messages_actions')
}
function readMessageIndex(subject, body, id, estate) {
   readMessageAction(subject, body, id, estate,'messages_actions')
}

function readMessageAction(subject, body, id, estate,action) {
    if (estate == 1) {
        $.ajax({
            url: action,
            async: false,
            type: "GET",
            data: "action=1&message=" + id,
            success: function(respuesta) {
                $('#myModalLabel').html(subject);
                $('#modal-body').html(body);
                $('#myModal').modal();
                $("#tr_" + id).removeClass("message_new");
                $("#tr_" + id).addClass("message_read");

            }
        });
    } else {
        $('#myModalLabel').html(subject);
        $('#modal-body').html(body);
        $('#myModal').modal();
    }

}



function deleteMessage(id, subject) {

    if (confirm('Delete Message ' + subject)) {
        $.ajax({
            url: "../messages_actions",
            async: false,
            type: "GET",
            data: "action=3&message=" + id,
            success: function(respuesta) {
                $("#tr_" + id).hide()
            }
        });
    }

}

function deleteMessageIndex(id,subject){
    if (confirm('Delete Message ' + subject)) {
        $.ajax({
            url: "messages_actions",
            async: false,
            type: "GET",
            data: "action=3&message=" + id,
            success: function(respuesta) {
                $("#tr_" + id).hide()
            }
        });
    }
}