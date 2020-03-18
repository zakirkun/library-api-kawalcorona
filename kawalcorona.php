<?php
namespace zakirkun\kawalcorona;
/**
 * Library From https://kawalcorona.com
 * @author Muhammad Zakir Ramadhan
 * @license MIT
 */
class kawalcoronaApi
{
	/**
	* Endpoint Api
	*/
	public $endpoint = "https://api.kawalcorona.com/";

	/**
	* @param option
	*/
	public $params;

	/**
	* @return array
	*/
	public $result = [];

	/**
	* @param $option array
	*
	* @return string
	*/
	public function __construct($option = [])
	{

		return $this->setOption($option);
	}

	/**
	* @param $option array
	*
	* @return string
	*/
	public function setOption($option = [])
	{
		if (isset($option['region'])) {
			$this->params = strtolower($option['region']);
		} elseif (isset($option['option'])) {
			$this->params = $option['option'];
		} else {
			$this->params = "";
		}
	}

	/**
	* @param $region string
	*
	* @return string
	*/
	public function setRegion($region)
	{
		return $this->params = $region;
	}

	/**
	* Get Data Ke Endpoint 
	*
	* @return array
	*/
	public function getData()
	{
		return json_decode(file_get_contents($this->endpoint.$this->params), true);
	}

	/**
	* Menampilkan Output Data Dari class::_parsing
	*
	* @return array
	*/
	public function result()
	{
		if (empty($this->getData())) {
			return $this->json(['success' => false, 'message' => 'data kosong']);
			die;
		}

		$this->result = array(
			'success' => true,
			'data'	=> $this->_parsing()
		);

		return $this->json($this->result);
	}


	/**
	* Parsing data dari class::getData 
	*
	* @return array
	*/
	public function _parsing()
	{
		$data = $this->getData();

		$this->result = [];


		if(count($data) > 2){
			foreach ($data as $d) {
				$this->result[] = array(
					'region'			=> $d['Country_Region'],
					'total'				=> $d['Confirmed'],
					'meninggal'			=> $d['Deaths'],
					'sembuh'			=> $d['Recovered'],
					'positif'			=> $d['Active']
				);
			}
		} else {
			$this->result = $data;
		}

		return $this->result;
	}

	/**
	* @param $data array
	*
	* @return json
	*/
	public function json($data)
	{
		return json_encode($data , JSON_PRETTY_PRINT);
	}
}
