<?php
session_start();
session_unset();
session_destroy();
?>
<script>
   localStorage.removeItem('index2_user'); // Clean browser memory
   window.location.href = 'index.php';
</script>