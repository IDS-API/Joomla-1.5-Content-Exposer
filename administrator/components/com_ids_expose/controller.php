<?php
/**
 * Joomla! 1.5 component ids_expose
 *
 * @version $Id: controller.php 2013-05-28 04:55:13 svn $
 * @author @iLabAfrica
 * @package Joomla
 * @subpackage ids_expose
 * @license GNU/GPL
 *
 * This component searches the joomla content and exposes it to the IDS data sets
 *
 * This component file was created using the Joomla Component Creator by Not Web Design
 * http://www.notwebdesign.com/joomla_component_creator/
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT.DS.'helpers'.DS.'helper.php' );

/**
 * ids_expose Controller
 *
 * @package Joomla
 * @subpackage ids_expose
 */
class Ids_exposeController extends JController {
    /**
     * Constructor
     * @access private
     * @subpackage ids_expose
     */
    function __construct() {
        //Get View
        if(JRequest::getCmd('view') == '') {
            JRequest::setVar('view', 'exposes');
        }
        
        parent::__construct();
    }

    function exposeNew()
    {
        $this->setRedirect('index.php?option=com_ids_expose&view=expose');
    }

    function getK2Authors(){
        
        $db =& JFactory::getDBO();

        $query = "SELECT DISTINCT `created_by`,`name` FROM `#__k2_items`,`#__users` WHERE `created_by`=`#__users`.`id` ORDER BY `name` ASC";
        $db->setQuery($query);
        $authors = $db->LoadObjectList();

        foreach ($authors as $author)
        {
            $name = $author->name;
            $id = $author->created_by;
            echo "<option value=\"".$id ."\">".$name ."</option>";
        }

    }

    function getJoomlaAuthors(){
        $model = &$this->getModel('expose');
        $authors = $model->getAuthors();

        foreach ($authors as $author)
        {
            $name = $author->name;
            $id = $author->created_by;
            echo "<option value=\"".$id ."\">".$name ."</option>";
        }

    }

    function getK2Categories(){
        
        $db =& JFactory::getDBO();

        $query = "SELECT DISTINCT `id`,`name` FROM `#__k2_categories` ORDER BY `name` ASC";
        $db->setQuery($query);
        $categories = $db->LoadObjectList();

        foreach ($categories as $category)
        {
            $name = $category->name;
            $id = $category->id;
            echo "<option value=\"".$id ."\">".$name ."</option>";
        }

    }

    function getJoomlaCategories(){
        $model = &$this->getModel('expose');
        $categories = $model->getJoomlaArticleCategories();

        foreach ($categories as $category)
        {
            $name = $category->title;
            $id = $category->id;
            echo "<option value=\"".$id ."\">".$name ."</option>";
        }

    }

    function getDocmanCategories(){
        $db =& JFactory::getDBO();

        $query = "SELECT DISTINCT `id`,`title` FROM `#__categories` WHERE section = 'com_docman' ORDER BY `title` ASC";
        $db->setQuery($query);
        $categories = $db->LoadObjectList();

        foreach ($categories as $category)
        {
            $name = $category->title;
            $id = $category->id;
            echo "<option value=\"".$id ."\">".$name ."</option>";
        }

    }

    function mappedFields(){
        $db =& JFactory::getDBO();
        $data  = JRequest::get('post');
        $source = $data['source'];

        $model = &$this->getModel('mapping');
        $ids_fields = $model->getIDSFields();
        $k2_extra_fields = $model->getK2ExtraFields();

        if($source == 'k2'){
            foreach (range(1, count($k2_extra_fields)) as $id) {
                if($data['ids_field'.$id] != ''){
                    foreach (explode(',', $data['items']) as $item_id) {
                        $query = "SELECT `extra_fields` FROM `#__k2_items` WHERE `id` = '$item_id'";
                        $db->setQuery( $query );
                        $extra_fields_data = $db->loadResult();
                        $extra_fields_data = json_decode($extra_fields_data);

                        foreach ($extra_fields_data as $key => $value) {
                            if($data['mapped_value'.$id] == $value->id ){
                                $mapped_fields[$data['ids_field'.$id]] = $value->value;
                            }
                        }

                    }
                    
                }
            }
        }else{
            foreach (range(1, count($ids_fields)) as $id) {
                if($data['ids_field'.$id] != ''){
                    $mapped_fields[$data['ids_field'.$id]] = $data['mapped_value'.$id];
                }
            }
        }

        if($mapped_fields){
            $this->expose($mapped_fields, $data['items'],$source);
        }else{
            $this->expose($mapped_fields[] = '', $data['items'],$source);
        }
    }   

    function expose($mapped_fields, $items,$source){
        $db =& JFactory::getDBO();
        $data  = JRequest::get('post');
        

        switch ($source) {
            case 'article':
                $query = "SELECT * 
                  FROM `#__content` 
                  WHERE `id`  IN ($items)";
                break;
            case 'k2':
                $query = "SELECT * 
                  FROM `#__k2_items`
                  WHERE `id`  IN ($items)";
                break;
            case 'docman':
                $query = "SELECT `id`,`dmname` as title,`dmdescription` as introtext,`catid`,`dmdate_published` as created,`dmsubmitedby` as created_by,`dmlastupdateon` as modified,`dmfilename` as slug
                  FROM `#__docman`
                  WHERE `id`  IN ($items)";
                break;

            default:
                $query = "SELECT * 
                  FROM `#__content` 
                  WHERE `id`  IN ($items)";
                break;
        }
        
        $db->setQuery($query);
        $result_set = $db->LoadObjectList();

        $date = date('Y-m-d H:i:s', time());

        if($source == 'k2'){
            //get category
            $catid = $result_set[0]->catid;
            $db->setQuery("SELECT `name` FROM `#__k2_categories` WHERE `id`=$catid");
            $cat = $db->loadResult();

            $identifier = urlencode(JURI::root().'index.php?option=com_k2&view=itemlist&layout=category&task=category&id='.$catid);
        
        }elseif($source == 'docman'){
            //get category
            $catid = $result_set[0]->catid;
            $db->setQuery("SELECT `title` FROM `#__categories` WHERE `id`=$catid");
            $category = $db->loadObject();
            $cat = $category->title;


            $identifier = urlencode(JURI::root().'index.php?option=com_docman');
        }else{
            //get category
            $catid = $result_set[0]->catid;
            $db->setQuery("SELECT `title` FROM `#__categories` WHERE `id`=$catid");
            $cat = $db->loadResult();

            $identifier = urlencode(JURI::root().'index.php?option=com_content&view=category&id='.$catid);
        }
            
            
        $count = count($result_set);
        $domain = JURI::root().'images/';

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= "<root>";
        $xml .="<head>\n\t";
        $xml .="<response_date>".$date."</response_date>\n\t\t";
        $xml .="<identifier>".$identifier."</identifier>\n\t\t";
        $xml .="<count>".$count."</count>\n\t\t";
        $xml .="</head>\n\t";
        $xml .="<results>\n\t";
        $extra_xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $extra_xml .= "<root>";
        $extra_xml .="<results>\n\t";
        foreach ($result_set as $asset) {

            $asset->introtext = str_replace('<img src="images/', '<img src="'.$domain, $asset->introtext);
            $created_by = JFactory::getUser($asset->created_by); echo "<br />";

            if($source == 'k2'){
                $asset_url = urlencode(JURI::root().'index.php?option=com_k2&view=item&id='.$asset->id);
            }elseif($source == 'docman'){
                $asset_url = urlencode(JURI::root().'index.php?option=com_docman&task=doc_download&gid='.$asset->id);
            }else{
                $asset_url = urlencode(JURI::root().'index.php?option=com_content&view=article&id='.$asset->id);
            }
            
            $introtext = ($asset->introtext)? $asset->introtext:$asset->fulltext; 
            $introtext = strip_tags($introtext); //uncomment to remove styles and formating from the article text
            $introtext = <<<EOF
$introtext
EOF;
            
            $xml .="<item>\n\t\t";
            $xml .= "<identifier>".$asset->id."</identifier>\n\t\t";
            if($source == 'docman'){
                $xml .= "<item_type>Document</item_type>\n\t\t";
            }elseif ($source == 'k2') {
                $xml .= "<item_type>K2 content</item_type>\n\t\t";
            }else{
                $xml .= "<item_type>Article</item_type>\n\t\t";
            }
            $xml .= "<title>".$asset->title."</title>\n\t\t";
            $xml .= "<description>".htmlspecialchars($introtext)."</description>\n\t\t";
            $xml .= "<url>".$asset_url."</url>";
            $xml .= "<item_url>".$asset_url."</item_url>";
            $xml .= "<date_created>".$asset->created."</date_created>\n\t\t";
            $xml .= "<date_updated>".$asset->modified."</date_updated>\n\t\t";
            $xml .= "<publication_year>".date('Y', strtotime($asset->created))."</publication_year>\n\t\t";
            $xml .= "<author>".$created_by->name."</author>\n\t\t";
            $xml .= "<language>".$asset->language."</language>\n\t\t";
            $xml .= "<doc_language>".$asset->language."</doc_language>\n\t";
            $xml .= "<keyword>".str_replace(',', ';', $asset->metakey)."</keyword>\n\t\t";
            $xml .= "<subject>".$cat."</subject>\n\t\t";

            if($mapped_fields){
                foreach ($mapped_fields as $key => $value) {
                    if($value){
                        $xml .= '<'.$key.'>'.htmlspecialchars($value).'</'.$key.'>';
                    }
                }
            }

            $xml.="</item>\n";
        }

        $xml.="</results>\n\t";
        $xml.="</root>\n\r";
                
        $xmlobj=new SimpleXMLElement($xml);
        
        //output xml in your response: 
        $xmlobj->asXML(JPATH_ROOT."/exposed_data.xml");

        //send the exposed data to eldis@ids.ac.uk as an email attachment
        $body = JURI::root().'exposed_data.xml';
        $mailer =& JFactory::getMailer();
        $mailer->setSender($created_by->email);
        $reply = array($created_by->email);
        $mailer->addReplyTo($reply);
        //$mailer->addRecipient('api@ids.ac.uk');
        //$mailer->addRecipient('eldis@ids.ac.uk');
        $mailer->addRecipient('eatwa@strathmore.edu');
        $mailer->setSubject('Exposed Data Results');
        $mailer->setBody($body);
        $mailer->addAttachment(JPATH_ROOT."/exposed_data.xml");

        $mailer->IsHTML(true);

        if($mailer->Send()){
            $mail_sent = '&mail_sent=1';
        }else{
            $mail_sent = '&mail_sent=0';
        }

        $this->setRedirect('index.php?option=com_ids_expose&view=exposed_xml');
    }

    function cancel()
    {
        $this->setRedirect('index.php?option=com_ids_expose&view=exposes');
    }
}
?>