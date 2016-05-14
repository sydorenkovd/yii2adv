<?php

$this->registerCss( <<< EOT_CSS

    .column
    {
        border:1px solid black;
        padding: 5px;
    }

    #layout
    {
        position:relative;
        margin:2pt auto;
        width:1400px;
    }
    
    #colSx 
    {
        width:200px;
        float:left;
    }

    #colCenter 
    {
        width:600px;
        float:left;
    }

    #colDx 
    {
        width:200px;
        float:left;
    }
        
     
EOT_CSS
);

?>

<?php
$this->registerJS( <<< EOT_JS
    
    function resizeLayout()
    {
        var windowWidth = $(window).width();
        
        if(windowWidth > 1400)
        {
            $('#colSx').css('display', 'block');
            $('#colCenter').css('display', 'block');
            $('#colDx').css('display', 'block');
            $('#layout').css('width', 1400);
        }
        else if((windowWidth>1200)&&(windowWidth<=1400))
        {
            $('#colSx').css('display', 'block');
            $('#colCenter').css('display', 'block');
            $('#colDx').css('display', 'none');
            $('#layout').css('width', 1200);
        }
        else if(windowWidth<1200)
        {
            $('#colSx').css('display', 'none');
            $('#colCenter').css('display', 'block');
            $('#colDx').css('display', 'none');
            $('#layout').css('width', 1000);
        }
        
    }
   
    $(window).resize(function() {
        resizeLayout();
    });
    
    $(function() {
        resizeLayout();
    });
   
EOT_JS
);
?>

<div id="layout">
    <div id="colSx" class="column">
        <br /><br />
        Content of SX Column
        <br /><br />
    </div>
    <div id="colCenter" class="column">
        <br /><br />
        Content of Central Column
        <br /><br />
    </div>
    <div id="colDx" class="column">
        <br /><br />
        Content of DX Column
        <br /><br />
    </div>
</div>