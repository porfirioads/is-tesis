<?php

namespace Tests\Feature;

class F01S02_GetUsers_UserListEmpty_Test extends F01_GetUsers
{
    public function testGivenTheUserListIsEmpty() {
        $this->theUsersListIsEmpty();
    }

    public function testWhenTheUsersListIsReturned() {
        $this->theUsersListIsReturned();
    }

    public function testThenNoUsersAreReturned() {
        $this->noUsersAreReturned();
    }
}
