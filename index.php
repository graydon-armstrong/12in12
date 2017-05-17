<?php
    $page_title = '12in12';
    $page_description = 'A site for completing a 12in12 Steam Backlog';
    
    include 'head.php';    
    include 'header.php';
    include 'nav.php';
?>

<div class="row">
    <div class="large-12 columns">
        <h1>Welcome to 12in12</h1>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <h3>Proof of Concept</h3>
        <p>This is a proof in concept of a backlog manager for the 12in12 system that has its own community on reddit.</p>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <h3>Games in 12in12</h3>
        
        <div class="primary progress">
            <div class="progress-meter" style="width: 16.66%">
                <p class="progress-meter-text">2/12</p>
            </div>
        </div>
        
        <div class="game">
            <h4 class="gamename">Mass Effect 2</h4>
            <img src="resources/images/masseffect2.jpg">
        </div>
    </div>
</div>

<div class="row">
    <div class="large-12 columns">
        <h3>Completed Games</h3>
        
        <div class="game">
            <h4 class="gamename">Abzu</h4>
            <img src="resources/images/abzu.jpg">
        </div>
        
        <div class="game">
            <h4 class="gamename">Refunct</h4>
            <img src="resources/images/refunct.jpg">
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
