<?php 
if(isset($_GET['date']) && !empty($_GET['date'])) : 
    $date = $_GET['date']; 

    if (is_file($_SERVER['DOCUMENT_ROOT'] . '/logs/date/' . $date . '.txt')) : ?>
    <div class="row" id="display-logs">
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Logs du <?php echo $date ?></h2>
          <input class="mb-4 form-select" id="search-logs-input" type="date" max="<?php echo date('Y-m-d')?>" value="<?php echo $date?>" onchange="searchLogs()" style="width:30%;">
        <div id="logs-display">
        <?php require($_SERVER['DOCUMENT_ROOT'] . '/logs/date/' . $date . '.txt'); ?>
       </div>
      </main>
    </div>
    <?php else : ?>
    <div class="row" id="display-logs">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Logs du <?php echo $date ?></h2>
                <input class="mb-4 form-select" id="search-logs-input" type="date" max="<?php echo date('Y-m-d')?>" value="<?php echo $date?>" onchange="searchLogs()" style="width:30%;">
            <div id="logs-display">
                <p>Il n'y a pas de logs à cette date.<p>
            </div>
        </main>
    </div>
    <?php endif; ?>
<?php endif; ?>