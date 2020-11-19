<?php
interface IMySqlActions {
  public function list ($page = 1, $limit = 20, $filter = [], $sort = []);
}