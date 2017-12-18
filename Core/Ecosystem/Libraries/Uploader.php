<?php
/*
|--------------------------------------------------------------------------
| Upload Class
|--------------------------------------------------------------------------
| This class handle uploading of multiple files
|
|
*/
namespace Skytells\Libraries\Streaming;
Class Uploader
{
	const KEY = 'fc01e8d00a90c1d392ec45459deb6f12'; // Please set your key for encryption here
	protected $_fileInput = array();
	protected $_files = array();

	protected $_fileNames = array();
	protected $_fileTypes = array();

	protected $_fileTempNames = array();

	protected $_fileExtensions = array();

	protected $_fileErrors = array();

	protected $_fileSizes = array();
	protected $_directoryPath = '/';
	protected $_debug = array();
	protected $_encryptedFileNames = array();
	protected $_allowedExtensions = array('jpg', 'png');
	protected $_maxSize = null;

	protected $_isMultiple = false;
	protected $_fileTypesToEncrypt = array();
	protected $_customErrorMessages = array();
	/**
	 * Setting all the attributes with file data and check if it's single or multiple upload.
	 */
	public function __construct($input = null)
	{
		if(empty($input) && !isset($_FILES[$input]))
			return;

		$this->_fileInput = $_FILES[$input];
		$this->_isMultiple = $this->isMultiple($this->_fileInput);

		$this->_fileNames = $this->_fileInput['name'];
		$this->_fileTypes = $this->_fileInput['type'];
		$this->_fileTempNames = $this->_fileInput['tmp_name'];
		$this->_fileErrors = $this->_fileInput['error'];
		$this->_fileSizes = $this->_fileInput['size'];
		$this->_fileExtensions = $this->getFileExtensions();
		$this->_files = $this->orderFiles($this->_fileInput);
	}
	/**
	 * This method organized the files in a an array of keys for each file.
	 *
	 * @param Array | $files
	 *
	 * @return Array | $sortedFiles
	 */
	public function orderFiles(Array $files)
	{
		$sortedFiles = array();

		foreach($files as $property => $values)
		{
			foreach($values as $key => $value)
			{
				$sortedFiles[$key] = array(
											'name' => $files['name'][$key],
											'encrypted_name' => '',
											'type' => $files['type'][$key],
											'extension' => $this->_fileExtensions[$key],
											'tmp_name' => $files['tmp_name'][$key],
											'error' => $files['error'][$key],
											'size' => $files['size'][$key],
											'encryption' => false,
											'success' => false,
											'errorMessage' => '',
										);

			}

		}
		return $sortedFiles;
	}
	/**
	 * This method allow the developer to set some rules for the upload process.
	 *
	 * @param Array | $rules
	 *
	 * @return Object | $this
	 */
	public function addRules(Array $rules)
	{
		foreach($rules as $rule => $value)
		{
			switch($rule)
			{
				case 'size':
					$this->_maxSize = @intval($value);
					break;
				case 'extensions':
					if($extensions = explode('|', $value))
					{
						$this->_allowedExtensions = $extensions;
						break;
					}
					$this->_allowedExtensions[] = $value;
					break;
				default:
					$this->_debug[] = 'Sorry but this rule you specfied does not exist';
					break;
			}
		}
		return $this;
	}
	/**
	 * This method allows the developer to set custom error messages.
	 *
	 * @param Array | $errorMessages
	 *
	 * @return Void
	 */
	public function customErrorMessages(Array $errorMessages)
	{
		foreach($errorMessages as $ruleName => $customMessage)
		{
			switch($ruleName)
			{
				case 'size':
					$this->_customErrorMessages[$ruleName] = $customMessage;
					break;
				case 'extensions':
					$this->_customErrorMessages[$ruleName] = $customMessage;
					break;
				default:
					$this->_debug[] = 'Sorry but this rule you specfied does not exist';
					break;
			}
		}
	}
	/**
	 * This method checks if its files or file.
	 *
	 * @param Array | $input
	 *
	 * @return Boolean
	 */
	protected function isMultiple(Array $input)
	{
		if(count($_FILES['file']['name']) > 1)
			return true;

		return false;
	}
	/**
	 * Get the extentions of the files.
	 *
	 * @return Array
	 */
	protected function getFileExtensions()
	{
		$extensions = array();
		foreach($this->_fileNames as $filename)
		{
			$str = end(explode('.', $filename));
			$extension = strtolower($str);
			$extensions[] = $extension;
		}

		return $extensions;
	}
	/**
	 * Set the path directory where you want to upload the files(if not specfied file/files
	 * will be uploaded to the current directory).
	 *
	 * @param String
	 *
	 * @return Object | $this
	 */
	public function setDirectory($path)
	{
		if(substr($path , -1) == '/')
			$this->_directoryPath = $path;
		else
			$this->_directoryPath = $path . '/';
		return $this;
	}
	/**
	 * start the upload process
	 *
	 * @return Void
	 */
	public function start()
	{
		if(empty($this->_fileInput))
			return;
		if(!file_exists($this->_directoryPath))
		{
			$this->_debug[] = 'Sorry, but this path does not exists. you can also set create() to true.
									 Example: $this->setDirectory(\'images\')->create(true);';
			return;
		}

		foreach($this->_files as $key => &$file)
		{
	    	if($this->fileIsNotValid($file))
	    		continue;
	    	$fileToUpload = ($this->shouldBeEncrypted($file)) ? $this->_directoryPath . $file['encrypted_name'] :
	    												 		$this->_directoryPath . $file['name'];
	    	if(!move_uploaded_file($file['tmp_name'], $fileToUpload))
				$file['success'] = false;
			else
				$file['success'] = true;
		}
	}
	/**
	 * This method checks if the file should be encrypted
	 *
	 * @param Array | $file
	 *
	 * @return Boolean
	 */
	protected function shouldBeEncrypted($file)
	{
		return $file['encryption'];
	}
	/**
	 * This method decrypt the file name based on the key you specfied.
	 *
	 * @param $encryptedName
	 *
	 * @return String | Decrypted File Name
	 */
	public function decryptFileName($encryptedName)
	{
		$encryptedName = str_replace('#', '/' , $base64EncodedString);
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, static::KEY, base64_decode($encryptedCode), MCRYPT_MODE_ECB));
	}
	/**
	 * Save the file/files with the random name on the server(optional for security uses).
	 *
	 * @param Boolean | $generate
	 *
	 * @return Object | $this
	 */
	public function encryptFileNames($encrypt = false)
	{
		if($encrypt == false)
			return $this;
		if(empty(static::KEY))
		{
			$this->_debug[] = 'Please go to Upload.class.php file and set manually a key inside the const KEY
								     of 32 characters to encrypt your files. keep this key in safe place as well.
								     you can call $this->generateMeAKey() to generate a random 32 characters key';
			return;
		}

		if(!empty($this->_fileInput))
		{
			foreach($this->_fileNames as $key => $fileName)
			{
				$base64EncodedString = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, static::KEY, $fileName, MCRYPT_MODE_ECB));
				$encryptedName = str_replace('/', '#' , $base64EncodedString);

				$extension = $this->_fileExtensions[$key];
				$this->_files[$key]['encrypted_name'] = $encryptedName . "." . $extension;
			}
		}
		return $this;
	}
	/**
	 * Allow the user to specify which file types to encrypt
	 *
	 * @param $types
	 *
	 * @return Void
	 */
	public function only($types)
	{
		if(is_array($types))
		{
			$this->_fileTypesToEncrypt = $types;
		}
		else if(is_string($types))
		{
			if($extensions = explode('|', $types))
				$this->_fileTypesToEncrypt = $extensions;
		}

		foreach($this->_files as $key => &$file)
		{
			if(in_array($this->_fileExtensions[$key], $this->_fileTypesToEncrypt))
				$file['encryption'] = true;
		}

		return;
	}
	/**
	 * This method create the directory if needed
	 *
	 * @param Boolean | $create
	 *
	 * @return Void
	 */
	public function create($create = false)
	{
		if($create == false)
			return $this;
		if(!file_exists($this->_directoryPath))
			mkdir($this->_directoryPath);
	}
	/**
	 * Check if extensions allowed
	 *
	 * @return Boolean
	 */
	protected function extensionsAllowed(&$file)
	{
		if(empty($this->_allowedExtensions) && empty($this->_fileExtensions))
			return;

		if(in_array($file['extension'], $this->_allowedExtensions))
			return true;

		$file['success'] = false;
		$file['errorMessage'] = (isset($this->_customErrorMessages['extensions'])) ?
												$this->_customErrorMessages['extensions'] :
												"Sorry, but only " . implode( ", " , $this->_allowedExtensions ) . " files are allowed.";
		return false;
	}
	/**
	 * Check if the file size allowed
	 *
	 * @return Boolean
	 */
	protected function maxSizeOk(&$file)
	{
		if(empty($this->_maxSize) && empty($this->_fileSizes))
			return;

		if($file['size'] < ($this->_maxSize * 1000))
			return true;

		$file['errorMessage'] = (isset($this->_customErrorMessages['size'])) ?
												$this->_customErrorMessages['size'] :
												"Sorry, but your file, " . $file['name'] . ", is too big. maximal size allowed " . $this->_maxSize . " Kbyte";

		return false;
	}
	/**
	 * Check if file validation fails
	 *
	 * @return Boolean
	 */
	protected function fileIsNotValid(&$file)
	{
		if($file['error'] !== UPLOAD_ERR_OK)
	    {
	    	$this->_debug[] = 'The file ' . $file['name'] . ' couldn\'t be uploaded. Please ensure
	    							your php.ini file allow this size of files to be uploaded';
	    	$file['errorMessage'] = 'Invalid File: ' . $file['name'];
	    	return false;
	    }
		if($this->extensionsAllowed($file) && $this->maxSizeOk($file))
			return false;

		return true;
	}
	/**
	 * This method checks if the upload was unsuccessful.
	 *
	 * @return Boolean
	 */
	public function unsuccessfulFilesHas()
	{
		foreach($this->_files as $file)
		{
			if($file['success'] == false && !empty($file['errorMessage']))
				return true;
		}

		return false;
	}
	/**
	 * This method checks if the upload was successful.
	 *
	 * @return Boolean
	 */
	public function successfulFilesHas()
	{
		foreach($this->_files as $file)
		{
			if($file['success'] == true)
				return true;
		}

		return false;
	}
	/**
	 * This method get the errors array to give some feedback to the user.
	 *
	 * @return Array
	 */
	public function errorFiles()
	{
		$failedUploads = array();
		foreach($this->_files as $key => $file)
		{
			if($file['success'] == true)
				continue;

			$failedFile = new stdClass();

			$failedFile->name = $file['name'];
			if($this->shouldBeEncrypted($file))
				$failedFile->encryptedName = $file['encrypted_name'];

			$failedFile->type = $file['type'];
			$failedFile->extension = $file['extension'];
			$failedFile->size = $file['size'];
			$failedFile->error = $file['error'];

			if(!empty($file['errorMessage']))
				$failedFile->errorMessage = $file['errorMessage'];
			$failedUploads[] = $failedFile;
		}

		return $failedUploads;
	}
	/**
	 * This method get the errors array to give some feedback to the user.
	 *
	 * @return Array
	 */
	public function successFiles()
	{
		$successfulUploads = array();
		foreach($this->_files as $key => $file)
		{
			if($file['success'] == false)
				continue;

			$successfulFile = new stdClass();

			$successfulFile->name = $file['name'];
			if($this->shouldBeEncrypted($file))
				$successfulFile->encryptedName = $file['encrypted_name'];

			$successfulFile->type = $file['type'];
			$successfulFile->extension = $file['extension'];
			$successfulFile->size = $file['size'];
			$successfulUploads[] = $successfulFile;
		}

		return $successfulUploads;
	}
	/**
	 * This method displays the errors formated nicely with bootstraps.
	 *
	 * @return Void
	 */
	public function displayErrors()
	{
		foreach($this->errorFiles() as $file)
	    {
	      echo '<div class="alert alert-danger">couldn\'t upload ' . $file->name .'. '. $file->errorMessage . '</div>';
	    }
	}
	/**
	 * This method displays the errors formated nicely with bootstraps.
	 *
	 * @return Void
	 */
	public function displaySuccess()
	{
		foreach($this->errorFiles() as $file)
	    {
	      echo '<div class="alert alert-success">' . $file->name .' uploaded successfuly</div>';
	    }
	}
	/**
	 * This method check if the file is set. normally when the user submits the form.
	 *
	 * @return Boolean
	 */
	public static function formIsSubmitted()
	{
		if(empty($_FILES))
			return false;
		if($_FILES['file']['size'] <= 0)
			return false;

		return true;
	}
	/**
	 * A simple gererator of a random key to use for encrypting
	 */
	public static function generateMeAKey()
	{
		echo md5(uniqid());
	}
	/**
	 * This method get the errors array to give some feedback to the developer.
	 *
	 * @return Array
	 */
	public function debug()
	{
		return $this->_debug;
	}
}
