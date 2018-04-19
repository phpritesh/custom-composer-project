<?php namespace Ritesh\Test;
/**
 * FaceDetection
 *
 * @package    Face
 * @author     Ridvan Baluyos <ridvan@baluyos.net>
 * @link       https://github.com/ridvanbaluyos/face
 * @license    MIT
 */
class FaceDetection
{
	private $url;
	private $subscriptionKey;
	private $image;
	private $analyzeFaceLandmarks = false;
	private $analyzeAge = false;
	private $analyzeGender = false;
	private $analyzeHeadPose = false;

	/**
	 * Constructor
	 */
	public function __construct($image) {
		echo "222222222222222";
		$this->subscriptionKey = '3cbf0a432790404087df51f68f02b0eb';
		$this->url = 'https://westus.api.cognitive.microsoft.com/face/v1.0/detect';
		$this->image = $image;
	}

	/**
	 * Get all the face/s detected in an image.
	 *
	 */
	public function getFaces() {
		$params = array(
			'subscription-key' => $this->subscriptionKey,
			'analyzesFaceLandmarks' => $this->analyzeFaceLandmarks,
			'analyzesAge' => $this->analyzeAge,
			'analyzesGender' => $this->analyzeGender,
			'analyzesHeadPose' => $this->analyzeHeadPose,
			  //'returnFaceAttributes' => 'age,gender,headPose,smile,facialHair,glasses',
		);
		
		$query = http_build_query($params);

		$image = json_encode($this->image);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url . '?' . $query);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $image);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($image))
		);

		$response = curl_exec($ch);

		header("Content-Type: application/json");
		if (!$response) {
			echo json_encode(array("statusCode"=>"406", "message"=>"There was no response from the server."));
		} else {
			echo $response;
		}
	}

	/**
	 * Optional parameter to get face landmarks.
	 *
	 */
	public function analyzeFaceLandmarks() {
		$this->analyzeFaceLandmarks = 'true';

		return $this;
	}

	/**
	 * Optional parameter to get age.
	 *
	 */
	public function analyzeAge() {
		$this->analyzeAge = 'true';

		return $this;
	}

	/**
	 * Optional parameter to get gender.
	 *
	 */
	public function analyzeGender() {
		$this->analyzeGender = 'true';

		return $this;
	}

	/**
	 * Optional parameter to get values of head-pose.
	 *
	 */
	public function analyzeHeadPose() {
		$this->analyzeHeadPose = 'true';

		return $this;
	}

	/**
	 * Alternatively, you can enable all options.
	 *
	 */
	public function analyzeAll() {
		$this->analyzeFaceLandmarks = 'true';
		$this->analyzeAge = 'true';
		$this->analyzeGender = 'true';
		$this->analyzeHeadPose = 'true';

		return $this;
	}
}
