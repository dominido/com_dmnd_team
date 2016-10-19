<?php

defined('_JEXEC') or exit();

class Dmnd_teamModelMember extends JModelAdmin {

	public function getForm($data = array(), $loadData = true) {

		$form = $this->loadForm(
			'com_dmnd_team.member',
			'member',
			array(
				'control' => 'jform',
				'load_data' => $loadData
				)
			);

		if (empty($form))
			return false;
		else
			return $form;
	}

	public function getTable($type = 'Member', $prefix = 'Dmnd_teamTable', $config = array()) {
		return JTable::getInstance($type, $prefix, $config);
	}

	protected function prepareTable($table) {

		$jinput = JFactory::getApplication()->input;


		$fewitems = $jinput->get('fewitems', array(), 'ARRAY');
    $items_count = $jinput->get('items_count', '1', 'NUM');
    $phone_refactored = array();
    for ($i=0, $j=0; $i < $items_count; $i++) { 

      if ($fewitems[$i]) {
        $phone_refactored[$j++] = $fewitems[$i];
      }
    }
		$table->phone = serialize($phone_refactored);
    

		$image = $jinput->files->get('jform');
		$image = $image['image'];
		$reloadpic = $jinput->get('onepic', '', 'RAW');

		if ($image) {

			if(isset($image) && !empty($image['name'])) {

				jimport('joomla.filesystem.file');

				$newfilename = uniqid().'-'.$image['name'];
				$newfilename = JFile::makeSafe($newfilename);
				$src = $image['tmp_name'];
				$path = JPATH_SITE . '/images/team/';
				$dest = $path . $newfilename;

				$table->image = $newfilename;

				// JFile::upload($src, $dest);

        include(JPATH_SITE.'/administrator/components/com_infire/libs/class.upload.php');

        // $thumb_filename = explode('.', $newfilename);
        // $thumb_filename = 'thumb-' . $thumb_filename[0];
        // JFile::copy($dest, $path . 'thumb-' . $newfilename);

        $uploaded_pic    = new Upload($image);
        if ($uploaded_pic->uploaded) { 

          // $uploaded_pic->Process(JPATH_SITE.'/images/team/');
          // if ($uploaded_pic->processed) {
          // } else {
          //   echo 'error : ' . $uploaded_pic->error;
          // }
          // save uploaded image with a new name
          $uploaded_pic->file_new_name_body = JFile::stripExt($newfilename);
          $uploaded_pic->Process(JPATH_SITE.'/images/team/');
          if ($uploaded_pic->processed) {
          } else {
            echo 'error : ' . $uploaded_pic->error;
          }  


          $uploaded_pic->file_new_name_body = 'thumb-' . JFile::stripExt($newfilename);;
          $uploaded_pic->image_resize          = true;
          $uploaded_pic->image_ratio_crop      = true;
          $uploaded_pic->image_y               = 200;
          $uploaded_pic->image_x               = 200; 
          $uploaded_pic->Process(JPATH_SITE.'/images/team/');
          if ($uploaded_pic->processed) {
            $uploaded_pic->Clean();
          } else {
            echo 'error : ' . $uploaded_pic->error;
          } 


            // $uploaded_pic->file_overwrite = true;
            // $uploaded_pic->file_auto_rename = false;

            // $uploaded_pic->image_resize          = true;
            // $uploaded_pic->image_ratio_crop      = true;
            // $uploaded_pic->image_y               = 200;
            // $uploaded_pic->image_x               = 200;                    
            // $uploaded_pic->process(JPATH_SITE.'/images/team/');
            // if ($uploaded_pic->processed) {
            //     // echo 'image resized';
            //     $uploaded_pic->clean();
            // } else {
            //     echo 'error : ' . $uploaded_pic->error;
            // }
        }

				if ($reloadpic)
					JFile::delete($path . $reloadpic);
			}
		}

		$table->check();
		$table->store();

	}

	protected function loadFormData() {
		$data = $this->getItem();

		return $data;
	}


	public function getItem($pk = null) {
		if ($item = parent::getItem($pk)) {

			return $item;
		}

		return false;
	}

	public function delete (&$pks) {

		for ($i=0; $i < count($pks); $i++) { 

			$this->_db->setQuery('select * from #__dmnd_team where id = '.$pks[$i]);
			$item = $this->_db->loadObject();

			$image = $item->image;

			if ($image) {

				jimport('joomla.filesystem.file');

				$path = JPATH_SITE . '/images/team/';
				JFile::delete($path . $image);
				JFile::delete($path .'thumb-'. $image);
			}		
		}

		parent::delete($pks);
  }

  public function savelist(&$ordering)
  {
    $table         = $this->getTable();
    $pks           = (array) $pks;

    JPluginHelper::importPlugin($this->events_map['save']);

    // Access checks.
    foreach ($ordering as $i => $val)
    {
      if ($table->load($i))
      {

        // Skip changing of same state
        if ($table->ordering == $val)
        {
          unset($ordering[$i]);
          continue;
        }

        $table->ordering = (int) $val;

        // Allow an exception to be thrown.
        try
        {
          if (!$table->check())
          {
            $this->setError($table->getError());

            return false;
          }


          // Store the table.
          if (!$table->store())
          {
            $this->setError($table->getError());

            return false;
          }

        }
        catch (Exception $e)
        {
          $this->setError($e->getMessage());

          return false;
        }
      }
    }

    return true;
  }

    protected function imgResize($src, $out, $width, $height, $color = 0xFFFFFF, $quality = 100,$is_transparency=true, $subdir='')
    {
          if (!file_exists($src)) {
              return false;
          }

          // Получаем массив с информацией о размере и формате картинки (mime)
          if($size = getimagesize($src))
          {
              if($size[0]==$width and $size[1]==$height){return true;}
              // Исходя из формата (mime) картинки, узнаем с каким форматом имеем дело
              $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
              if($format=='png'){$quality=9;}

              //и какую функцию использовать для ее создания
              $picfunc = 'imagecreatefrom'.$format;

              // Вычилсить горизонтальное соотношение
              $gor = $width  / $size[0];
              // Вертикальное соотношение
              $ver = $height / $size[1];

              // Если не задана высота, вычислить изходя из ширины, пропорционально
              if ($height == 0) {
                  $ver = $gor;
                  $height  = $ver * $size[1];
              }
                  // Так же если не задана ширина
                  elseif ($width == 0) {
                  $gor = $ver;
                  $width   = $gor * $size[0];
              }

              // Формируем размер изображения
              $ratio   = min($gor, $ver);
              // Нужно ли пропорциональное преобразование
              if ($gor == $ratio)
                  $use_gor = true;
              else
                  $use_gor = false;

              $new_width   = $use_gor  ? $width  : floor($size[0] * $ratio);
              $new_height  = !$use_gor ? $height : floor($size[1] * $ratio);
              $new_left    = $use_gor  ? 0 : floor(($width - $new_width)   / 2);
              $new_top     = !$use_gor ? 0 : floor(($height - $new_height) / 2);

              if ($use_gor && $new_height < $height) {
                  $new_width   = floor($size[0] * $ver);
                  $new_height  = $height;
              }
              if (!$use_gor && $new_width < $width) {
                  $new_width   = $width;
                  $new_height  = floor($size[1] * $gor);
              }
              $new_left    = 0;
              $new_top     = 0;

              $picsrc  = $picfunc($src);
              // Создание изображения в памяти
              $picout = imagecreatetruecolor($width, $height);

              if($is_transparency && $format == 'png'){
                      imagefill($picout, 0, 0, 0x7fff0000);
                      imageAlphaBlending($picout, false);
                      imageSaveAlpha($picout, true);
              }
              else{
                      imagefill($picout, 0, 0, $color);
              }

              // Заполнение цветом

              // Нанесение старого на новое
              // imagecopyresampled(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
              imagecopyresampled($picout, $picsrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

                // $cor = imagecolorallocate($picout, 0, 0, 0);
                // imagestring($picout,1,5,5,'$use_gor-'.$use_gor,$cor);

              // Создание файла изображения
              //imagejpeg($picout, $out, $quality);
              $func_image = 'image'.$format;
              $func_image($picout, $out, $quality);

              // Очистка памяти
              imagedestroy($picsrc);
              imagedestroy($picout);

              return true;
          }
          return false;
    }
}