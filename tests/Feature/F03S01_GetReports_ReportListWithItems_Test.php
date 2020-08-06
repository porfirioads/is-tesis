<?php

namespace Tests\Feature;

class F03S01_GetReports_ReportListWithItems_Test extends F03_GetReports
{
    public function testGivenTheReportsListHasItems()
    {
        $this->theReportsListHasItems();
    }

    public function testAndIAmLoggedAsAnAdmin()
    {
        $this->iAmLoggedAsAnAdmin();
    }

    public function testWhenTheReportsListIsReturned()
    {
        $this->theReportsListIsReturned();
    }

    public function testThenEachElementHasTheIdAttribute()
    {
        $this->eachElementHasTheAttribute('id');
    }

    public function testAndEachElementHasTheTipoAttribute()
    {
        $this->eachElementHasTheAttribute('tipo');
    }
}
