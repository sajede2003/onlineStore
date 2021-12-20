<h1> home page </h1>

<?php if(!empty($user_name)): ?>
<h3> welcome <?= $user_name ?></h3>
<?php endif;?>

<?php 
?>


<input type="hidden" value="<?= isset($message)?$message:''?>" id="message">

<script>

    var SweetAlertMessage = document.querySelector('#message').value;
    if (SweetAlertMessage.trim() !== '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: SweetAlertMessage,
        })
    }

</script>



