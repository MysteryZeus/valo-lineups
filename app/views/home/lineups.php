<html>
    <header>
        <title>Lineups for <?php echo $data['agent']; ?> on <?php echo $data['map']; ?></title>
        <link href="/css/lineup.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </header>
    <body>
        <div id="header">
            <h1 id="title">Lineups for <?php echo $data['agent']; ?> on <?php echo $data['map']; ?></h1>
            <img id="agent" src="">
            <div id="site"></div>
        </div>
        <div id="body">
            <ul id="list">
                <?php
                    foreach ($data['lineups'] as $lineup) {
                        echo '<li><ul>';
                        echo '<li><span>' . $lineup['description'] . '</span></li>';
                        echo '<li><img src="' . $lineup['image_position'] . '"></li>';
                        echo '<li><img src="' . $lineup['image_aim'] . '"></li>';
                        if ($lineup['video_id']) {
                            echo '<li><div class="container"><iframe src="https://www.youtube.com/embed/' . $lineup['video_id'] . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></li>';
                        } else {
                            echo '<li><img src="https://cdn.discordapp.com/attachments/870462002538086410/875291227770208286/Comming_Soon.png"></li>';
                        }
                        
                        echo '</ul></li>';
                    }
                ?>
            </ul>
        </div>
    </body>
</html>