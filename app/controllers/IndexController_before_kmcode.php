<?php

namespace App\Controllers;

use App\Helpers\Helpers;
use App\Helpers\PdfHelper;
use App\Helpers\PdfHelperPETExam;
use App\Helpers\PdfHelperDVExam;
use App\Helpers\PdfHelperDMEExam;
use App\Helpers\PdfHelperSkillTest;
use App\Controllers\FrontEndController;
use App\Models\Menu as Menu;
use App\Models\Users as User;
use App\System\Route;

use App\Models\Nomination as Nomination;
use App\Models\Examtype as Examtype;
use App\Models\Nominationchild as Nominationchild;

use App\Models\Selectionpost as Selectionpost;

use App\Models\Selectionpostschild as Selectionpostschild;
use App\Models\Admitcard as Admitcard;
use App\Models\Knowyourstatus as Knowyourstatus;
use App\Models\Exam as Exam;

use App\Models\Category as Category;
use App\Models\Phase as Phase;
use App\Models\Debarredlists as Debarredlists;
use App\Models\Notice as Notice;
use App\Models\Tender as Tender;
use App\Models\ImportantLinks as ImportantLinks;
use App\Models\Gallery as Gallery;


class IndexController extends FrontEndController
{
    public function __construct($param_data = array())
    {
        parent::__construct($param_data);
        $menu  = new Menu();
		//for header published menus
        ob_start();
        \App\Helpers\Helpers::showMenuLinks($menu->getMenusForPublish());
        $menuStr = ob_get_clean();
        // echo $menuStr;
        $this->data['renderedMenu'] = $menuStr;
		
		//for footer published menus
		 ob_start();
        \App\Helpers\Helpers::showFooterMenuLinks($menu->getFooterMenusForPublish());
        $footermenuStr = ob_get_clean();
        // echo $menuStr;
        $this->data['renderedFooterMenu'] = $footermenuStr;
		
    }
    public function index()
    {
        // login
        $data = $this->login();
		$data['nominations'] =  Helpers::getNomination();
		$data['nominationchildlist'] =  Helpers::getNominationChildList();
		$data['notices'] = Helpers::getNotice();
		// Important links and Gallery
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
        $this->render("home", $data);
    }
    public function adminlogin()
    {
        $data = $this->login();
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
        $this->render("admin_login", $data);
    }
	
    public function login()
    {
        $errorMsg = "";





		
        if (isset($_POST['login'])) {

           /*  // check captcha here
            if (false == $this->checkCaptcha($_POST['captcha_code'])) {
                $errorMsg = "Captcha validation fails";
                return ['errorMsg' => $errorMsg];
            } */
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username     = Helpers::cleanData(trim($_POST['username']));
                $password   = Helpers::cleanData(trim($_POST['password']));
                $md5Password = md5($password);
                $user = new User();

                if ($user->authenticate($username, $md5Password)) {
                    $route = new Route();
                    $route->redirect($route->site_url("Admin/dashboard/?action=listmenus&&status=0"));
                } else {
                    $errorMsg = "Wrong email or password";
                }
            }
        }
        if (isset($_GET['logout']) && $_GET['logout'] == true) {
            session_destroy();
            $route = new Route();
            $route->redirect($route->get_app_url());
        }


        if (isset($_GET['lmsg']) && $_GET['lmsg'] == true) {
            $errorMsg = "Login required to access dashboard";
        }
        return ['errorMsg' => $errorMsg];
    }

	public function admitcard($data = array()){ 

		$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$lastUriSegment = array_pop($uriSegments);

	
	//$data = $this->getadmitcard(); 	


	$data = Helpers::getAdmitCardDetails();
	//$this->printr($data);

	


	@$cnt = $data['count'];
	if ($cnt >= 1) {              
			switch ($data['exam_type']) {
			  case "tier":
			  //if exam type is written exam -start
				PdfHelper::genereateAndDownloadAdminCard($data);
			  //if exam type is written exam -end
				break;
			  case "skill":
				PdfHelperSkillTest::genereateAndSkillTestDownloadAdminCard($data);
				break;
			  case "pet":
				PdfHelperPETExam::genereateAndPETDownloadAdminCard($data); 
				break;
				case "dme":
					PdfHelperDMEExam::genereateAndDMEDownloadAdminCard($data); 
					break;
			  default:
				//if exam type is DV -start
				PdfHelperDVExam::genereateAndDVDownloadAdminCard($data);
			  //if exam type is DV -end
			}
	} 		
	    $data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
	    $this->render("admit_card", $data);    
	}
	
	
	/**** Admit card Preview    ******/
	
		public function admitcardpreview($data = array()){ 
	
			$data = Helpers::getAdmitCardPreviewDetails();
	//$this->printr($data);


	@$cnt = $data['count'];
	if ($cnt >= 1) {              
			switch ($data['exam_type']) {
			  case "tier":
			  //if exam type is written exam -start
				PdfHelper::genereateAndDownloadAdminCard($data);
			  //if exam type is written exam -end
				break;
			  case "skill":
				PdfHelperSkillTest::genereateAndSkillTestDownloadAdminCard($data);
				break;
			  case "pet":
				PdfHelperPETExam::genereateAndPETDownloadAdminCard($data); 
				break;
				case "dme":
					PdfHelperDMEExam::genereateAndDMEDownloadAdminCard($data); 
					break;
			  default:
				//if exam type is DV -start
				PdfHelperDVExam::genereateAndDVDownloadAdminCard($data);
			  //if exam type is DV -end
			}
	} 		
	    $data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();


    
	$this->render("admitcard_preview", $data);    
	}
	
	/**** Admit card Preview    ******/
	
	
	public function knowyourstatus($data = array())
    {
        $data = $this->getknowyourstatus();
		
		 @$cnt = $data['count']->count;
		
		
      
        if ($cnt == 1) {
			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
			
            $this->render("kyas_results", $data);
            exit;
        }
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
		

        $this->render("know_your_status", $data);
    }

	
	 public function faq($data = array())
    {
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();

        $this->render("faq", $data);
    }
	 public function gallerypage($data = array())
    {
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
       	$events = new Gallery();
		$yearBasedEvents = $events->getHomePhotoGalleryList();
		$data['yearBasedEvents'] = $yearBasedEvents;
        $this->render("gallery", $data);
    }
	
	public function candidateCorner($data = array())
    {
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
		$this->render("candidate_corner", $data);
    }
	
    public function getadmitcard()
    {
		Helpers::getAdmitCardDetails("admitcard");
		
    }
	
	 public function getknowyourstatus()
    {
        $errorMsg = "";
        if (isset($_POST['kyas'])) {

            $register_number     = trim($_POST['register_number']);
            $dob   = trim($_POST['dob']);
			$table_name = trim($_POST['table_name']);
			$data_array = array(
					"register_number"=>$register_number ,
					"dob"=>$dob ,
					"table_name"=>$table_name 
			);
			
			$data = explode('_',$table_name);
			$exam_year =  strtoupper($data[1]);
			
			
            $kyas = new Exam();
			
			
			
			//$this->printr($kyasresults);
            
            if ($kyas->getKyas($data_array)) {
				$kyasresults = $kyas->getKyas($data_array);
                $kyascount = $kyas->getCountKyas($data_array);
				$examname_by_year = $kyas->examNamebyYear($table_name);
                return ['kyasresults' => $kyasresults,'count'=>$kyascount,'examname'=>$examname_by_year,'year'=>$exam_year];
            } else {
                $errorMsg = "Wrong Register Number  or Date of Birth or Exam";
            } 
        }
        return ['errorMsg' => $errorMsg];
    }
	
	public function nomination()
		{

			$data['nominations'] =  Helpers::getNomination();
			$data['nominationchildlist'] =  Helpers::getNominationChildList();
			$data['categorylist'] = Helpers::getCategory();
			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
			$this->render("nomination", $data);
	}
	
	
	public function notice()
		{
			$data['notices'] = Helpers::getNotice();
			$data['categorylist'] = Helpers::getCategory();
			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
		    $this->render("notice", $data);
	}
	public function tender()
		{
			$data['tenders'] =  Helpers::getTender();
			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
			$this->render("tender", $data);
	}
	public function selectionpost()
	{
		$data['selectionposts'] = Helpers::getSelectionPost();
		$data['selectpostschildlist'] = Helpers::getSelectionPostChild();
		$data['categorylist'] = Helpers::getCategorySelectionPostsList();
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
		$this->render("selection_posts", $data);
	}


	public function pageunderconstruction($data = array()){
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
		$this->render("page_under_construction", $data);
	}


    private function checkCaptcha($captcha_code)
    {
        if ($captcha_code == $_SESSION['captcha_code']) {
            return true;
        } else {
            return false;
        }
    }
    public function chairmen()
    {
        echo "I am chairmen page";
    }
	public function getExamDetails()
    {
        //get matched data 
        try {
            $exam = new Exam();
            $q = isset($_GET['q']) ? $_GET['q'] : "";
            $exam_details = $exam->getExamfromExamDetailsTbl($q);
        } catch (Exception $Ex) {
            echo "Error" . $sql . "</br>" . $Ex;
        }
    $searchData =[];
	
    foreach ($exam_details as $insdata) {
		
		$textData = $insdata->exam_name." (".$insdata->table_exam_short_name.")"." (".$insdata->table_exam_year.")";
		
        $searchData[] =
            array('id' => $insdata->table_name,
                'text' =>$textData 
            );
    }

    echo json_encode($searchData);
    }
	
	/************************
	***  Admit card Exam Name Ajax
	*/
	
	public function getTierBasedExamDetails()
    {
			//get matched data 
			try {
				$exam = new Exam();
				$q = isset($_GET['q']) ? $_GET['q'] : "";
				$exam_details = $exam->getTierBasedTbl($q);
			} catch (Exception $Ex) {
				echo "Error" . $sql . "</br>" . $Ex;
			}
		$searchData =[];
		
		foreach ($exam_details as $insdata) {
			
			//$textData = $insdata->exam_name." (".$insdata->table_exam_short_name.")"." (".$insdata->table_exam_year.")";
			//$textData = $insdata->exam_name." (".$insdata->table_exam_short_name.")"." (".$insdata->table_exam_year.")";
			$examname =  $insdata->exam_name.','.$insdata->table_exam_year.'('.$insdata->table_type.') ('.$insdata->tier_name.')';
			
			//'',.r.'('.$insdata->tier_name.') ';
			
			$searchData[] =
				array('id' => $insdata->tableid,
					'text' =>$examname 
				);
		}

		echo json_encode($searchData);
    }


	public function getTierBasedExamDetailsPreview()
    {
			//get matched data 
			try {
				$exam = new Exam();
				$q = isset($_GET['q']) ? $_GET['q'] : "";
				$exam_details = $exam->getTierBasedTblPreview($q);
			} catch (Exception $Ex) {
				echo "Error" . $sql . "</br>" . $Ex;
			}
		$searchData =[];
		
		foreach ($exam_details as $insdata) {
			
			//$textData = $insdata->exam_name." (".$insdata->table_exam_short_name.")"." (".$insdata->table_exam_year.")";
			//$textData = $insdata->exam_name." (".$insdata->table_exam_short_name.")"." (".$insdata->table_exam_year.")";
			$examname =  $insdata->exam_name.','.$insdata->table_exam_year.'('.$insdata->table_type.') ('.$insdata->tier_name.')';
			
			//'',.r.'('.$insdata->tier_name.') ';
			
			$searchData[] =
				array('id' => $insdata->tableid,
					'text' =>$examname 
				);
		}


		echo json_encode($searchData);
    }
	
	
	
	/************************
	***  getTierMaster
	*/
	
	public function getTierMaster()
    {
        //get matched data 
        try {
            $exam = new Exam();
            $q = isset($_GET['q']) ? $_GET['q'] : "";
            $exam_details = $exam->getTierBasedMaster($q);
        } catch (Exception $Ex) {
            echo "Error" . $sql . "</br>" . $Ex;
        }
    $searchData=[] ;
	
    foreach ($exam_details as $insdata) {
		
		$textData = $insdata->tier_name;
		
        $searchData[] =
            array('id' => $insdata->tier_id,
                'text' =>$textData 
            );
    }

    echo json_encode($searchData);
    }
	
	
	public function getPhaseDetails()
    {
        //get matched data 
        try {
            $phase = new Phase();
            $q = isset($_GET['q']) ? $_GET['q'] : "";
            $phase_details = $phase->getPhasefromPhaseDetailsTbl($q);
        } catch (Exception $Ex) {
            echo "Error" . $sql . "</br>" . $Ex;
        }
    $searchData =[] ;
    foreach ($phase_details as $insdata) {
        $searchData[] =
            array('id' => $insdata->phase_id,
                'text' => $insdata->phase_name
            );
    }

    echo json_encode($searchData);
    }
	
	//get gallery distinct years
	public function getGalleryYears()
    {
        //get matched data 
        try {
            $Gallery = new Gallery();
            $q = isset($_GET['q']) ? $_GET['q'] : "";
            $gallery_event_years = $Gallery->getGalleryDistinctedYears($q);
        } catch (Exception $Ex) {
            echo "Error" . $sql . "</br>" . $Ex;
        }
    $searchData = [] ;
    foreach ($gallery_event_years as $insdata) {
        $searchData[] =
            array('id' => $insdata->year,
                'text' => $insdata->year
            );
    }

    echo json_encode($searchData);
    }
	
	//get year based gallery events 
	public function getYearBasedEvents()
    {
        //get matched data 
        try {
            $Gallery = new Gallery();
            $q = isset($_GET['year']) ? $_GET['year'] : "2022";
            $gallery_event_by_years = $Gallery->getGalleryEventsByYears($q);
        } catch (Exception $Ex) {
            echo "Error" . $sql . "</br>" . $Ex;
        }
    $searchData =[] ;
    foreach ($gallery_event_by_years as $insdata) {
        $searchData[] =
            array('id' => $insdata->gallery_id,
                'text' => $insdata->event_name
            );
    }

    echo json_encode($searchData);
    }
	
	
	
	// //getGalleryidBasedImages
	// public function getGalleryidBasedImages()
    // {
    //     //get matched data 
    //     try {
    //         $Gallery = new Gallery();
    //         $q =  $_POST['gallery_id'];
    //         $gallery_id_based_images = $Gallery->getGalleryidBasedImagesModel($q);

    //     } catch (Exception $Ex) {
    //         echo "Error" . $sql . "</br>" . $Ex;
    //     }
    // $searchData ;
    // foreach ($gallery_id_based_images as $insdata) {
    //     $searchData[] =
    //         array('id' => $insdata->image_path,
    //             'text' => $insdata->event_name.",".$insdata->year
    //         );
    // }

    // echo json_encode($searchData);
    // }
	

	public function dlist(){
		$data['dlist_details'] = Helpers::getDList();
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
        $this->render("debarred_list", $data);
		
	}

	
	public function ScreenReaderAccess(){
		 $this->render("screen_reader_access");
	}
	public function pdfgeneration($data = array()){
		$data['name'] = "stalin";
		$this->render("pdf_template",$data);
	}
	public function printr($data){
		echo '<pre>';
		print_r($data);
		exit;
	}
	
	/**
  * @author Stalin
  * @method : Know Your Roll Number
  */
	public function knowyourrollno($data = array())
    {
        $data = $this->getKnowYourRollNo();
		 @$cnt = $data['count'];
		 
		
        if ($cnt >= 1) {

			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
             $this->render("kyrn_results", $data);
            exit;
        }

		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();
        $this->render("know_your_roll_no", $data);
    }
	
 
	 public function getKnowYourRollNo()
    {
        $errorMsg = "";
        if (isset($_POST['admit_card'])) {
            $register_number     = trim($_POST['register_number']);
            $dob   = trim($_POST['dob']);
			
			$examname = trim($_POST['examname']);
			$examname = explode('_',$examname);
			$exam_value = $examname[0].'_'.$examname[1].'_'.$examname[2];
			$tier_id = $examname[3];
			
			
			
			$data_array = array(
				"table_name"=>$exam_value,
				"register_number"=>$register_number ,
				"dob"=>$dob ,
				"tier_id"=>$tier_id 
			);
            $admitcard = new Admitcard();
            
            if ($admitcard->getAdmitcard($data_array)) {
                $admitcardresults = $admitcard->getAdmitcard($data_array);
                $kyas = new Exam();
				$table_name = trim($exam_value);
				$examname_by_year = $kyas->examNamebyYear($table_name);
				$data = explode('_',$exam_value);
				$exam_year =  strtoupper($data[1]);
				//$exam_name = $admitcard->getExamName($examname );
                $count = count($admitcardresults);
                return ['admitcardresults' => $admitcardresults,'count'=>$count,'examname'=>$examname_by_year,'year'=>$exam_year ];
            } else {
                $errorMsg = "Wrong Register Number  or Date of Birth or Exam";
            }
        }
        return ['errorMsg' => $errorMsg];
    }
	/**
  * @author Stalin
  * @method : Know Your Roll Number
  */
  
  
  /**
  * @author Stalin
  * @method : Know Your Venue Details
  */
	public function knowyourvenuedetails($data = array())
    {
		
		
        $data = $this->getKnowYourVenueDetails();
		 @$cnt = $data['count'];
		 
		
		
        if ($cnt >= 1) {

			$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
			$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
			$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();

			$this->render("kyvd_results", $data);
			exit;
        }
		$data['ilinkforFirstFourRow'] = Helpers::getImporantLinksFirstFourRow();
		$data['ilinkforAfterFirstFourRow'] = Helpers::getImporantLinksAfterFourRow();
		$data['gallery_id_based_images'] = Helpers::getGalleryidBasedImages();

        $this->render("know_your_venue_details", $data);
    }
	
 
	 public function getKnowYourVenueDetails()
    {
        $errorMsg = "";
        if (isset($_POST['admit_card'])) {
            $register_number     = trim($_POST['register_number']);
            $dob   = trim($_POST['dob']);
			$examname = trim($_POST['examname']);
			$examname = explode('_',$examname);
			$exam_value = $examname[0].'_'.$examname[1].'_'.$examname[2];
			$exam_type = $examname[2];
			$tier_id = $examname[3];
			$data_array = array(
				"table_name"=>$exam_value,
				"register_number"=>$register_number ,
				"dob"=>$dob ,
				"tier_id"=>$tier_id 
			);
			
			//echo "<pre>";
			
			//print_r($data_array);
			
			
            $admitcard = new Admitcard();
            
            if ($admitcard->getAdmitcardforTier($data_array)) {
                $admitcardresults = $admitcard->getAdmitcardforTier($data_array);
                $kyas = new Exam();
				$table_name = trim($exam_value);
				$examname_by_year = $kyas->examNamebyYear($table_name);
				$data = explode('_',$exam_value);
				$exam_year =  strtoupper($data[1]);
				//$exam_name = $admitcard->getExamName($examname );
                $count = count($admitcardresults);
                return ['admitcardresults' => $admitcardresults,'count'=>$count,'examname'=>$examname_by_year,'year'=>$exam_year,"exam_type"=>$exam_type ];
            } else {
                $errorMsg = "Wrong Register Number  or Date of Birth or Exam";
            }
        }
        return ['errorMsg' => $errorMsg];
    }
	/**
  * @author Stalin
  * @method : Know Your Venue Details
  */
public function getPET(){
	   $modelClass = new Admitcard();
	   $data =  $modelClass->getQueryListPET();
	  	PdfHelperPETExam::genereateAndPETDownloadAdminCard($data);     
	  
	}
	public function getDV(){
	   $modelClass = new Admitcard();
	   $colmasterdetails =  $modelClass->getQueryListDV();
	   $st =  json_decode(json_encode($colmasterdetails), true);
	   $data2 = $modelClass->getQueryListDVResult();
	   $array = json_decode(json_encode($data2), true);
	  
		$arrays = [];
		 foreach($colmasterdetails as $val){
			 
			 foreach(array_keys($array) as $res ){
				 if($res == $val->col_name){
					$col_value =  $array[$res];
				 }
			 }
			 	 $arrays[] = array(
				"col_name"=>$val->col_name,
				"col_description"=>$val->col_description,
				"is_dv"=>$val->is_dv,
				"is_dv_order"=>$val->is_dv_order,
				"col_value"=>$col_value
				);
		} 
		
		$datavalue = (object)$arrays;

	  	PdfHelperDVExam::genereateAndDVDownloadAdminCard($datavalue); 
	}
	

	
}
