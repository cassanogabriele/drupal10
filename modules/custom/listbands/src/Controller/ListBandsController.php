<?php

namespace Drupal\listbands\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Render\Markup;

/**
 * Class DefaultController.
 */
class ListBandsController extends ControllerBase {
    /**
     * Liste des groupes.
     *
     * @return array
     *   Return Hello string.
     */
    public function list(){    
        /* return [
            '#markup' => $this->t('Hello, Custom Bands!'),
        ];*/
        $connection = Database::getConnection();
        
        $options = array();
        $result = $connection->query('SELECT * FROM listofbands', $options);
            
        $headers = array(
            'groupe' => Markup::create('<center><b>' . t('Groupes') . '</b></center>'),
            'style' => Markup::create('<center><b>' . t('Style') . '</b></center>'),
        );

        $data = array();

        foreach($result as $item) {
            $data[] = array(
                'groupe' => $item->band_name,       
                'style' => $item->style,                    
            );
        }

        $title_markup = Markup::create('<h2 style="text-align:center;margin-bottom:25px;">Liste de groupes de rock</h2>');

        $output = array(
            '#type' => 'markup',
            '#markup' => $title_markup,
        );

        $output['table'] = array(     
          '#theme' => 'table',
          '#header' => $headers,
          '#rows' => $data,
        );

        return $output;
    }
}
