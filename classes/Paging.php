<?php

namespace Classes;

class Paging
{
    public $current_page;
    public $records_per_page;
    public $total_records;

    public function __construct($current_page = 1, $records_per_page = 10, $total_records = 0)
    {
        $this->current_page = (int) $current_page;
        $this->records_per_page = (int) $records_per_page;
        $this->total_records = (int) $total_records;
    }

    public function offset()
    {
        return $this->records_per_page * ($this->current_page - 1);
    }

    public function totalPages()
    {
        return ceil($this->total_records / $this->records_per_page);
    }

    public function previousPage()
    {
        $previous_page = $this->current_page - 1;

        return ($previous_page > 0) ? $previous_page : false;
    }

    public function nextPage()
    {
        $next_page = $this->current_page + 1;

        return ($next_page <= $this->totalPages()) ? $next_page : false;
    }

    public function previousLink()
    {
        $html = '';

        if ($this->previousPage()) {
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->previousPage()}\">&laquo; Anterior </a>";
        }

        return $html;
    }

    public function nextLink()
    {
        $html = '';

        if ($this->nextPage()) {
            $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->nextPage()}\">Siguiente &raquo;</a>";
        }

        return $html;
    }

    public function pageNumbers()
    {
        $html = '';

        for ($i = 1; $i <= $this->totalPages(); $i++) {
            if ($i === $this->current_page) {
                $html .= "<span class=\"pagination__link pagination__link--current \">{$i}</span>";
            } else {
                $html .= "<a class=\"pagination__link pagination__link--number \" href=\"?page={$i}\">{$i}</a>";
            }
        }

        return $html;
    }

    public function paginationTemplate()
    {
        $html = '';

        if ($this->total_records > 1) {
            $html .= '<div class="pagination">';
            $html .= $this->previousLink();
            $html .= $this->pageNumbers();
            $html .= $this->nextLink();
            $html .= '</div>';
        }

        return $html;
    }
}
