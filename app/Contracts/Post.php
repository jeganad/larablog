<?php

namespace Naoray\Larablog\Contracts;

interface Post
{
    /**
     * A Post has to be applied to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author();
}
