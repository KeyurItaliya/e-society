<?php if($get_id){ ?>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="N"  <?php if ($status_type == 'N') echo 'checked="checked"'; ?>>
                <label class="form-check-label" for="inlineRadio2">Inactive</label>
                <input class="form-check-input" type="radio" name="status" id="active" value="Y"  <?php if ($status_type == 'Y') echo 'checked="checked"'; ?>>
                <label class="form-check-label" for="inlineRadio2">Active</label>
              </div>
            <?php } ?>