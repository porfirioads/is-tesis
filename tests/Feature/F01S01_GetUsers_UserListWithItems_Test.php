<?php

namespace Tests\Feature;

class F01S01_GetUsers_UserListWithItems_Test extends F01_GetUsers
{
    public function testGivenTheUserListHasItems() {
        $this->theUsersListHasItems();
    }

    public function testWhenTheUsersListIsReturned() {
        $this->theUsersListIsReturned();
    }

    public function testThenEachElementHasTheIdAttribute() {
        $this->eachUserHasTheAttribute('id');
    }

    public function testAndEachElementHasTheUsernameAttribute() {
        $this->eachUserHasTheAttribute('username');
    }
}
