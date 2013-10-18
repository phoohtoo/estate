<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    /* -----------------------------------------------------------------------------------
     * It's actualy not my own source, but I just want to share & bookmark it here ;)
     *
     * Thanks to Anggy Trisnawan
     * Url: http://anggytrisnawan.com/blog/2012/07/21/upload-multiple-file-codeigniter
     * -----------------------------------------------------------------------------------
     */
    function __construct()
    {
        parent::__construct();
        
        // load the libraries at first
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
        $this->load->library('image_lib');
    }
    
    // front view
    function index()
    {
        /* -----------------------------------------------------------------------------------
         * It's what you need for the 'upload' view
         * -----------------------------------------------------------------------------------
         * <?php echo form_open_multipart('upload/do_upload');?>
         *
         *     <!-- make sure you give an array (userfile[]) to the "name" attribute and have attribute "multiple" on it --> 
         *     <?php echo form_input( array( 'name'=>'userfile[]', 'multiple'=>true ) ); ?><br />
         *
         *     <!-- just, another submit button --> 
         *     <?php echo form_submit('submit', 'Upload'); ?>
         *
         * <!-- well, close the form -->
         * <?php echo form_close();?>
         * -----------------------------------------------------------------------------------
         */

        $this->load->view('upload', array('error' => ' ' ));
    }
    
    // Upload & Resize in action
    function do_upload()
    {
        $upload_conf = array(
            'upload_path'   => realpath('assets/'),
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '30000',
            );
    
        $this->upload->initialize( $upload_conf );
    
        // Change $_FILES to new vars and loop them
        foreach($_FILES['userfile'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
        // Unset the useless one ;)
        unset($_FILES['userfile']);
    
        // Put each errors and upload data to an array
        $error = array();
        $success = array();
        
        // main action to upload each file
        foreach($_FILES as $field_name => $file)
        {
            if ( ! $this->upload->do_upload($field_name))
            {
                // if upload fail, grab error 
                $error['upload'][] = $this->upload->display_errors();
            }
            else
            {
                // otherwise, put the upload datas here.
                // if you want to use database, put insert query in this loop
                $upload_data = $this->upload->data();
                
                // set the resize config
                $resize_conf = array(
                    // it's something like "/full/path/to/the/image.jpg" maybe
                    'source_image'  => $upload_data['full_path'], 
                    // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                    // or you can use 'create_thumbs' => true option instead
                    'new_image'     => $upload_data['file_path'].'thumb_'.$upload_data['file_name'],
                    'width'         => 200,
                    'height'        => 200
                    );

                // initializing
                $this->image_lib->initialize($resize_conf);

                // do it!
                if ( ! $this->image_lib->resize())
                {
                    // if got fail.
                    $error['resize'][] = $this->image_lib->display_errors();
                }
                else
                {
                    // otherwise, put each upload data to an array.
                    $success[] = $upload_data;
                }
            }
        }

        // see what we get
        if(count($error > 0))
        {
            $data['error'] = $error;
        }
        else
        {
            $data['success'] = $upload_data;
        }
        
        $this->load->view('upload',$data);
    }
}


/* End of file upload.php */
/* Location: ./application/controllers/upload.php */

?>