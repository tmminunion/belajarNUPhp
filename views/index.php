<?php $this->extend("layout/layout.php"); ?>



<div class="header pb-1 pt-1 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-image: url(<?= getpic() ?>); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-7"></span>
    <!-- Header container -->
   
</div>
<!-- Page content -->
<div class="container-fluid mt--9">
      <div class="container mt-5 mb-3">
    <div class="row">
     <?php foreach ($events as $event):
     ?>
     
    <nu-card-cardcip data='{"id":"<?= $event['event_date'] ?>", "event_name":"<?= $event['event_name'] ?>"}' class='class-<?= $event['event_location'] ?>'>
       <?= $event['organizer'] ?>
    </nu-card-cardcip>
<?php endforeach; ?>
      
      
        
        
    </div>
</div>  
            
            

</div>





<?php $this->block('scriptsheader') ?>
<style>
    .bg-gradient-primary-to-secondary {
        background: linear-gradient(45deg, #2937f0, #9f1ae2) !important;
    }
  
.card {
    border: none;
    border-radius: 10px
    min-height: 350px;
}

.c-details span {
    font-weight: 300;
    font-size: 13px
}

.icon {
    width: 50px;
    height: 50px;
    background-color: #eee;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 39px
}

.badge span {
    background-color: #fffbec;
    width: 60px;
    height: 25px;
    padding-bottom: 3px;
    border-radius: 5px;
    display: flex;
    color: #fed85d;
    justify-content: center;
    align-items: center
}

.progress {
    height: 10px;
    border-radius: 10px
}

.progress div {
    background-color: red
}

.text1 {
    font-size: 14px;
    font-weight: 600
}

.text2 {
    color: #a5aec0
}
</style>
<?php $this->endblock() ?>