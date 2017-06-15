<?php

namespace Nuntius\FacebookSendApi\Templates;

class FacebookTemplates {

  public $button;

  public $generic;

  public $list;

  public $openGraph;

  public $receipt;

  public $airlineBoarding;

  public $airlineCheckIn;

  public $airlineItinerary;

  public $airlineFlightUpdate;

  public $element;

  public $receiptElement;

  public $boardingPass;

  public $passengerInfo;

  public $flightInfo;

  public $passengerSegmentInfo;

  public $priceInfo;

  public function __construct() {
    $this->button = new Button();
    $this->generic = new Generic();
    $this->element = new Element();
    $this->list = new ListTemplate();
    $this->openGraph = new OpenGraph();
    $this->receiptElement = new ReceiptElement();
    $this->receipt = new Receipt();
    $this->airlineBoarding = new AirlineBoarding();
    $this->boardingPass = new BoardingPass();
    $this->airport = new Airport();
    $this->airlineCheckIn = new AirlineCheckIn();
    $this->airlineItinerary = new AirlineItinerary();
    $this->passengerInfo = new PassengerInfo();
    $this->flightInfo = new FlightInfo();
    $this->passengerSegmentInfo = new PassengerSegmentInfo();
    $this->priceInfo = new PriceInfo();
//    $this->airlineFlightUpdate = new AirlineFlightUpdate();
  }

}