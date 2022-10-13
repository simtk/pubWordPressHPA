<?php
while ( have_rows( 'content_rows' ) ) : the_row();
    get_template_part( '_partials/layouts/_' . get_row_layout() );
endwhile; ?>