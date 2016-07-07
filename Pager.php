<?php

class Pager {

  const lINKSCOUNT = 5;

  private $dataList;
  private $elementsPerPage;
  private $currentPage;
  private $dataCount;
  private $pages;
  private $startLink;
  private $endLink;
  private $data;

  public function __construct() {
    if(isset($_GET['page'])) {
      if(is_numeric($_GET['page']) && $_GET['page'] > 0) {
        $this->currentPage = (int) $_GET['page'];
      } else {
        $this->currentPage = 1;
      }
    } else {
      $this->currentPage = 1;
    }
    if(isset($_GET['elementsPerPage'])) {
      if(is_numeric($_GET['elementsPerPage']) && $_GET['elementsPerPage'] > 0) {
        $this->elementsPerPage = (int) $_GET['elementsPerPage'];
      } else {
        $this->elementsPerPage = 5;
      }
    } else {
      $this->elementsPerPage = 5;
    }
    $a = func_get_args();
    $i = func_num_args();
    if(method_exists($this, $f = '__construct' . $i)) {
      call_user_func_array(array($this, $f), $a);
    }
  }

  private function __construct0() {
    $this->fectData(50);
  }

  private function __construct1($data) {
    $this->fectData($data);
  }

  private function fectData($n) {
    $i = 0;
    while($i < $n) {
      $this->dataList[$i] = 'examData ' . ($i + 1);
      $i++;
    }
    $this->dataCount = count($this->dataList);
    $this->elementsPerPage = $this->elementsPerPage > $this->dataCount ? $this->dataCount : $this->elementsPerPage;
    $this->setLinksData();
    $this->setData();
  }

  private function setLinksData() {
    $this->pages = ceil($this->dataCount * 1.0 / $this->elementsPerPage);
    $this->startLink = $this->currentPage - 2;
    $this->endLink = $this->currentPage + 2;
    if($this->endLink > $this->pages) {
      $this->endLink = $this->pages;
      $this->startLink = $this->pages - 4;
    }
    if($this->startLink < 1) {
      $this->endLink = self::lINKSCOUNT;
      $this->startLink = 1;
    }
    if($this->endLink > $this->pages) {
      $this->endLink = $this->pages;
    }
    $this->currentPage = $this->currentPage > $this->endLink ? $this->endLink : $this->currentPage;
  }

  private function setData() {
    $count = ($this->currentPage - 1) * $this->elementsPerPage + $this->elementsPerPage;
    if($count > $this->dataCount) {
      $count = $this->dataCount;
    }
    for($i = ($this->currentPage - 1) * $this->elementsPerPage; $i < $count; $i++) {
      $this->data[] = $this->dataList[$i];
    }
  }

  private function getDataHtml() {
    $html = '<table>';
    $html .= '<tr><th>column 1</th><th>column 2</th><th>column 3</th><th>column 4</th></tr>';
    foreach($this->data as $value) {
      $html .= '<tr><td>' . $value . '</td><td>' . $value . '</td><td>' . $value . '</td><td>' . $value . '</td></tr>';
    }
    $html .= '</table>';
    return $html;
  }

  private function getLinksHtml() {
    $html = '<ul>';
    if($this->currentPage !== 1) {
      $html .= '<li><a href="/viscompExam/' . 1 . '/' . ($this->elementsPerPage !== 5 ? $this->elementsPerPage . '/' : '') . '">Първа</a></li>';
      $html .= '<li><a href="/viscompExam/' . ($this->currentPage - 1) . '/' . ($this->elementsPerPage !== 5 ? $this->elementsPerPage . '/' : '') . '">Предищна</a></li>';
    }
    for($i = $this->startLink; $i <= $this->endLink; $i++) {
      if((int) $this->currentPage === (int) $i) {
        $html .= '<li><a>[' . $i . ']</a></li>';
      } else {
        $html .= '<li><a href="/viscompExam/' . $i . '/' . ($this->elementsPerPage !== 5 ? $this->elementsPerPage . '/' : '') . '">' . $i . '</a></li>';
      }
    }
    if($this->currentPage < $this->pages) {
      $html .= '<li><a href="/viscompExam/' . ($this->currentPage + 1) . '/' . ($this->elementsPerPage !== 5 ? $this->elementsPerPage . '/' : '') . '">Следваща</a></li>';
      $html .= '<li><a href="/viscompExam/' . $this->pages . '/' . ($this->elementsPerPage !== 5 ? $this->elementsPerPage . '/' : '') . '">Последна</a></li>';
    }
    $html .= '</ul>';
    return $html;
  }

  public function draw() {
    echo $this->getDataHtml() . $this->getLinksHtml();
  }

}
