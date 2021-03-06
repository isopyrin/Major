<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$newFormat = majors_Plugin::getFormat();
if (Major::postAble($newFormat)) exit; ?>

<?php $this->need('header.php'); ?>

<div class="articles-post post-header">
    <div class="JudgmentProject <?php if($this->fields->thumbUrl && !empty($this->options->useBlock) && in_array('usePostContentImg', $this->options->useBlock)) :?>usePostContentImg<?php endif;?>">
        <div class="post-head mdui-color-theme" id="post-image">
            <div class="back">
                <button onclick="historyBack();" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
            </div>
            <div class="container">
                <div class="title">
                    <h1><?php $this->sticky(); $this->title(); ?></h1>
                    <div class="subtitle-row1">
                            <span>
                                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                            </span>
                        <span>
                                <?php $this->category(','); ?>
                            </span>
                        <span>
                                <i class="icon-eye icons"></i>
                            <?php majors_Plugin::theViews(); ?>
                            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-head-row">
            <div class="container">
                <div class="subtitle">
                    <div id="post-images"></div>
                    <div class="subtitle-row2">
                            <span>
                                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                            </span>
                        <span>
                                <?php $this->category(','); ?>
                            </span>
                        <span>
                                <i class="icon-eye icons"></i>
                            <?php majors_Plugin::theViews(); ?>
                            </span>
                    </div>
                </div>
                <?php include 'res/postAuthor.php';?>
            </div>
        </div>
    </div>
</div>

<script>
    var postImage = document.getElementById("post-images");
    postImage.innerHTML = '<?php $imageSrc = in_array('usePostContentImg', $this->options->useBlock) ? $this->fields->thumbUrl : ''; $imageSrc = $imageSrc ? '<img id="imageSrc" src="'.$imageSrc.'" alt="'.$this->title.'" />' : ''; echo($imageSrc);?>';

    function RGBiamge(){
        if(document.getElementById("imageSrc")){
            var thumbUrl = "<?php $this->fields->thumbUrl(); ?>";
            var site = document.domain;
            var img;
            if( thumbUrl.indexOf(site) > 0) {
                img = thumbUrl;
            }else{
                img = '<?php echo Major::$api['api']."proxy/?proxy="; ?>'+thumbUrl;
            }
            RGBaster.colors(img, {
                // return up to 30 top colors from the palette
                paletteSize: 30,
                // don't count white
                exclude: [ 'rgba(10, 154, 65, 0.97)' ],
                // do something when done
                success: function(payload){
                    var postImage = document.getElementById("post-image");
                    postImage.style.cssText='background-color:'+payload.dominant+'!important;';
                    //console.log('Dominant color:', payload.dominant);
                    //console.log('Secondary color:', payload.secondary);
                    //console.log('Palette:', payload.palette);
                }
            });
        }
    }
    RGBiamge();
</script>

<div class="majors-post-articles post <?php echo $newFormat; ?>" id="main" role="main">
    <div class="container">
        <article class="major-article article-shadow content-wrap" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="post-content major-text" data-wow-offset="10" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <?php include 'res/showfoot.php'?>
        </article>
    </div>
</div>

<div class="comment-here">
    <div class="container">
        <?php $this->need('comments.php'); ?>
    </div>
</div>

<?php $this->need('footer.php'); ?>