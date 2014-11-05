$.ajax({
    type: 'get',
    url: '<?php echo $this->Html->url(array('action' => 'favorites', 'ext' => 'json')); ?>',
    beforeSend: function(xhr) {
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    },
    success: function(response) {
        if (response.error) {
            alert(response.error);
            console.log(response.error);
        }
        if (response.content) {
            $('#target').html(response.content);
        }
    },
    error: function(e) {
        alert("An error occurred: " + e.responseText.message);
        console.log(e);
    }
});