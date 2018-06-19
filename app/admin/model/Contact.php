<?php

class Contact extends Main
{
    public function index()
    {
        $sql = "SELECT * FROM contacts";
        $paging = $this->paging->get_content($this->pdo->count_rows($sql), 10);
        $sql .= $paging['sql_add'];
        $contacts = $this->pdo->fetch_all($sql);
        foreach($contacts as $key => $contact)
        {
            $contacts[$key]['status'] = $this->helper->help_get_text_status($contact['status'], 'contacts', $contact['id']);
            $contacts[$key]['created_at'] =  gmdate("H:i A d/m/Y", time() + 7 * 3600);
        }
        $this->smarty->assign('paging', $paging);
        $this->smarty->assign('contacts', $contacts);
        $this->smarty->display(DEFAULT_LAYOUT);
    }

    public function ajax_active()
    {
      if( isset($_POST['table']) && isset($_POST['id']) )
      {
        $user = $this->pdo->fetch_one("SELECT status FROM " . $_POST['table'] . " WHERE id=" . $_POST['id']);
        $status = $user['status'] == 1 ? 0 : 1;
        if($user['status'] == 1)
            exit();
        $this->pdo->query("UPDATE " . $_POST['table'] . " SET status = '$status' WHERE id=" . $_POST['id']);
        echo $this->helper->help_get_text_status($status, $_POST['table'], $_POST['id']);
        exit();
      }
      else
      {
        echo 0;
        exit();
      }
    }

    function ajax_get_detail_contact()
    {
        $id = $_POST['id'];
        $sql = "SELECT * FROM contacts WHERE id = $id";
        $contact = $this->pdo->fetch_one($sql);
        echo json_encode($contact);
        exit();
    }

}