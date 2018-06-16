<?php

class Setting extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->Image = new Image();
        $this->Filehandle = new FileHandle();
        $this->SettingHelper = new SettingHelper();
        $this->redirectIfEmployee();
        $this->redirectIfManager();
    }


    function info()
    {
        $content = array();
        if (file_exists($this->file_setting))
        {
            $content = parse_ini_file($this->file_setting, true);
        }

        if (isset($_POST ['submit']))
        {
            $content ['info'] ['name'] = strip_tags(trim($_POST ['name']));
            $content ['info'] ['address'] = strip_tags(trim($_POST ['address']));
            $content ['info'] ['description'] = strip_tags(trim($_POST ['description']));
            $content ['info'] ['phone'] = strip_tags(trim($_POST ['phone']));
            $content ['info'] ['email'] = strip_tags(trim($_POST ['email']));


            if ( isset($_FILES['logo']) && $this->helper->check_type($_FILES['logo']['type']) )
            {
                if (file_exists($this->arg['logo_folder_path'] . "/" . $content['logo']['image']))
                {
                    unlink($this->arg['logo_folder_path'] . "/" . $content['logo']['image']);
                }
                $ext = $this->SettingHelper->get_extension($_FILES['logo']['type']);
                $image_name = "logo" . time() . '.' . $ext;
                move_uploaded_file($_FILES['logo']['tmp_name'], $this->arg['logo_folder_path'] . "/" . $image_name);
                $content ['logo'] ['image'] = $image_name;
            }

            $arrini = $this->dstring->arr2ini($content);
            file_put_contents($this->file_setting, $arrini);
            lib_alert('Lưu thông tin thành công');
            lib_redirect(THIS_LINK);
            exit();
        }

        $out['name'] = @$content ['info'] ['name'];
        $out['address'] = @$content ['info'] ['address'];
        $out['phone'] = @$content ['info'] ['phone'];
        $out['email'] = @$content ['info'] ['email'];
        $out['description'] = @$content ['info'] ['description'];
        $out['logo'] = $this->arg['logo_folder_link'] . "/" . $content['logo']['image'];
        $this->smarty->assign('out', $out);
        $this->smarty->display(DEFAULT_LAYOUT);
    }
}