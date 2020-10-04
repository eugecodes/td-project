<?php

class notasDeClientes extends WP_Widget {
     function notasDeClientes() {
	    $widget_ops = array('description' => 'Otras notas de cliente' );
        parent::WP_Widget(false, $name = 'Otras notas de cliente',$widget_ops);	
    }


    function widget($args, $instance) {
      global $wpdb;		
      extract( $args );
      $title = $instance['title'];
        ?>
<script>
		/* No Modificar */

		var $j = jQuery.noConflict();

		function guardar_click(cliente, banner){
			console.log("cliente "+ cliente);
			console.log("banner "+ banner);
			$j.post( "../../../../../contador_banners/contador_clicks.php",
			{
				'data':'guardar_click',
				'cliente': cliente,
				'banner': banner
			}, function(data) {
				console.log(JSON.stringify(data));
			});
		}
</script>
		
<div>
<!--<a href="http://www.hansgrohe-la.com/select" target="_blank"><img src="http://www.espaciotradem.com/wp-content/uploads/2016/04/banner-hansgrohe.jpg"></a>-->
<img src="http://www.espaciotradem.com/pixel/87d41cc52fc76b4004806abc6317d15a.png" style="width:1px; height:1px;">
</div>

<?php echo $before_widget; ?>
<?php if ( $title ) echo $before_title . $title . $after_title; 
$cliente = get_post_meta(get_the_ID(),'cliente',true);
$activoClienteCant = 0;


if (!empty($cliente)) {
  // Contectamos a buscar los datos del cliente
  $mysqli = new mysqli("localhost", "tradem_user_et", "2EeHrkIA", "tradem_et");
  // local
  //$mysqli = new mysqli("localhost", "root", "globaljp", "tradem_espacio");
  if ($mysqli->connect_errno) {
    return false;
  }
  // Veo si el cliente está activo o no
  $activoCliente = $mysqli->query("SELECT id 
    FROM nuke_clientes
    WHERE id = $cliente and activo='0' limit 1"
    );

  $activoClienteCant = $mysqli->num_rows;
}



if (empty($cliente) or $activoClienteCant==1) : 
  $categories = get_the_category(get_the_ID());
  $idNotaActual = get_the_ID();
  ?>

<?php  query_posts( array( 'post_type' => 'post', 'category__and' => array($categories[0]->cat_ID),'showposts'=>5,'orderby' => 'date','order' => DESC ) ); 
  if (have_posts()) : ?>
  <ul id="notasRelacionadas">

<?php while (have_posts()) : 
  the_post();
  if (get_the_ID()===$idNotaActual)
    continue;

?>
  <li><h3><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h3>
    <!--<a href="<?php //the_permalink(); ?>" target="_blank"><?php //echo the_post_thumbnail('thumbnails-relacionada',array('class'=>'imgRelacionada')); ?></a>-->
  </li>


  <?php endwhile; ?>
  </ul>
 <?php endif; 
 wp_reset_query();  ?>
<?php 
    return false;
endif;
  //return false;

/*$notasClienteET = $wpdb->get_results( 
    "SELECT id_articulo 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='espacio' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5"
    );

$idPostET = array();
  foreach ($notasClienteET as $key => $value) {
    $idPostET[] = $value->id_articulo;
    //echo $value->id_articulo."<br>";
  }*/
// Buscamos Notas de TD
$idPostET = array();
$wpdb->query("SELECT `post_id`,`meta_key`, `meta_value` FROM $wpdb->postmeta
        WHERE `meta_key` = 'cliente' and meta_value = $cliente AND post_id<>'".get_the_ID()."'  ORDER BY `post_id` DESC LIMIT 5
    ");
    foreach($wpdb->last_result as $k => $v){
      $idPostET[] = $v->post_id;
    }

$clienteDatos = getCliente($cliente);
 
if (!empty($idPostET)):
  query_posts( array( 'post_type' => 'post', 'post__in' => $idPostET ) ); 
    if (have_posts()) : ?>
    <?php if(!empty($clienteDatos)): ?>
    <h2>Otras Notas Asociadas de <?php echo utf8_encode($clienteDatos["nombre"]); ?> en TrademDesign.com</h2>
    <ul id="notasRelacionadas">
  <?php endif; ?>
  <?php while (have_posts()) : the_post();  ?>
    <li><h3><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h3>
      <!--<a href="<?php //the_permalink(); ?>" target="_blank"><?php //echo the_post_thumbnail('thumbnails-relacionada',array('class'=>'imgRelacionada')); ?></a>-->
    </li>


    <?php endwhile; ?>
    </ul>
   <?php endif; wp_reset_query();  

endif;
 ?>

<?php 
/*
// Buscamos Notas de ET
$notasClienteET = $mysqli->query( 
    "SELECT id_articulo,titulo,permalink,imagen 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='espacio' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5"
    );

echo "SELECT id_articulo,titulo,permalink,imagen 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='espacio' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5";

$notasClienteEtCant = $mysqli->num_rows;

*/



/*
$queryET = "SELECT id_articulo,titulo,permalink,imagen 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='espacio' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5";


SELECT p . *
FROM wp_postmeta AS pm
INNER JOIN wp_posts AS p ON pm.meta_value = p.ID
WHERE pm.post_id =2871
AND pm.meta_key = '_thumbnail_id'
ORDER BY p.post_date DESC 




    */

$queryET = "SELECT `post_id`,`meta_key`, `meta_value` FROM $wpdb->postmeta
        WHERE `meta_key` = 'cliente' and meta_value = $cliente ORDER BY `post_id` DESC LIMIT 5";

//echo $queryET;


if ($relET = $mysqli->query($queryET)): 
  if ($relET->num_rows>0):

  ?>

  <h2>Otras Notas Asociadas de <?php echo utf8_encode($clienteDatos["nombre"]); ?> en EspacioTradem.com</h2>
    <ul id="notasRelacionadas">

<?php
      while ($value = $relET->fetch_object()) : ?>

<?php

$r = "SELECT * FROM wp_posts WHERE ID='".$value->post_id."'";
//echo $r."<br>";

?>

  <?php if ($relWPET = $mysqli->query($r)): ?>
  <?php  while ($p = $relWPET->fetch_object()): ?>
  <li><h3><a href="<?php echo $p->guid; ?>" target="_blank"><?php echo utf8_encode($p->post_title); ?></a></h3>
<?php 
  $queryIMG = "SELECT p . *
    FROM wp_postmeta AS pm
    INNER JOIN wp_posts AS p ON pm.meta_value = p.ID WHERE pm.post_id ='".$p->ID."' AND pm.meta_key = '_thumbnail_id'
    ORDER BY p.post_date DESC ";
//echo "<script>console.log('"$queryIMG"');</script>";
?>

  <?php if ($relWPIMGET = $mysqli->query($queryIMG)): ?>
    <?php  while ($pIMG = $relWPIMGET->fetch_object()): 
      $urlIMG = parse_url($pIMG->guid);
      $imgP = explode('.', $urlIMG["path"]);
      //$imgP = $urlIMG['scheme']."://".$urlIMG['host'].$imgP[0]."-390x126.".$imgP[1];
	  $imgP = $urlIMG['scheme']."://".$urlIMG['host'].$urlIMG['path'];
      //var_dump(parse_url($pIMG->guid));
      //echo "<script>console.log('"$imgP"');</script>";
    ?>
	<a href="<?php echo $p->guid; ?>" target="_blank"><img src="<?php echo $imgP; ?>" class="imgRelacionada wp-post-image" /></a>
    <!--<a href="<?php //echo $p->guid; ?>" target="_blank"><img src="<?php //echo $imgP; ?>" class="imgRelacionada wp-post-image" /></a>-->
  <?php endwhile;?>

  <?php endif; ?>  

  </li>
  <?php endwhile;?>
<?php endif; ?>


<?php   endwhile;
    //$result->close();?>
  </ul>
<?php
endif;
endif;

/*
if ($notasClienteEtCant>=1): ?>
  <h2>Otras Notas Asociadas de <?php echo $clienteDatos["nombre"]; ?> en TrademStyle.com</h2>
    <ul id="notasRelacionadas">

<?php  while ($value = $notasClienteET->fetch_object()) : ?>
          <li><h3><a href="<?php echo $value->permalink; ?>" target="_blank"><?php echo utf8_decode($value->titulo); ?></a></h3>
            <a href="<?php echo $value->permalink; ?>" target="_blank"><img src="<?php echo $value->imagen; ?>" class="imgRelacionada wp-post-image" /></a>
          </li>

<?php endwhile; ?>
    </ul>

<?php endif;*/?>

<?php




// Buscamos Notas de TS
/*
$notasClienteTS = $mysqli->query( 
    "SELECT id_articulo,titulo,permalink,imagen 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='style' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5"
    );*/


$notasClienteTS = $mysqli->query( 
    "SELECT id_articulo,titulo,permalink,imagen 
    FROM nuke_clientes_stats
    WHERE id_cliente = $cliente and sitio='style' ORDER BY `nuke_clientes_stats`.`id_articulo` DESC limit 5"
    );

$notasClienteTsCant = $notasClienteTS->num_rows;
if ($notasClienteTsCant>=1): ?>
  <h2>Otras Notas Asociadas de <?php echo utf8_encode($clienteDatos["nombre"]); ?> en TrademStyle.com</h2>
    <ul id="notasRelacionadas">

<?php  while ($value = $notasClienteTS->fetch_object()) : ?>
          <li><h3><a href="<?php echo $value->permalink; ?>" target="_blank"><?php echo $value->titulo; //echo htmlentities($value->titulo, null, "utf-8"); ?></a></h3>
            <a href="<?php echo $value->permalink; ?>" target="_blank"><img src="<?php echo $value->imagen; ?>" class="imgRelacionada wp-post-image" /></a>
          </li>

<?php endwhile; ?>
    </ul>

<?php endif;?>


<?php echo $after_widget; ?>
 

<?php
    }
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
    return $instance;
    }

 	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance );
?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Título:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
    </p>

<?php  } 
} 
add_action('widgets_init', create_function('', 'return register_widget("notasDeClientes");')); // register widget
?>