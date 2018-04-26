        <div class="row">
          <section class='col-xs-12 col-sm-6 col-md-6'>
            <section>
              <h2>How to use this example application</h2>
                <p>For instructions on how to use this application with OpenShift, start by reading the <a href="http://docs.openshift.org/latest/dev_guide/templates.html#using-the-quickstart-templates">Developer Guide</a>.</p>


                <h2>Request information</h2>
                <p>Page view count:
               <?php
                    use Cake\Datasource\ConnectionManager;

                    $hasDB=1;
                    $tableExisted=0;
                    try {
                      $connection = ConnectionManager::get('default');
                    } catch(Exception $e) {
                      $hasDB=0;
                    }
                    if ($hasDB) {
                        try {
                          $connection->execute('create table view_counter (c integer)');
                        } catch (Exception $e) {
                        	$tableExisted=1;
                        }
                        try {
                            if ($tableExisted==0) {
                            	$connection->execute('insert into view_counter values(1)');
                            } else {
                                $connection->execute('update view_counter set c=c+1');
                            }
                            $result=$connection->execute('select * from view_counter')->fetch('assoc');;
                        } catch (Exception $e) {
                            $hasDB=0;
                        }
                    }
                ?>
                <?php if ($hasDB==1) : ?>
                   <span class="code" id="count-value"><?php print_r($result['c']); ?></span>
                   </p>
                <?php else : ?>
                   <span class="code" id="count-value">No database configured</span>
                   </p>
                <?php endif; ?>

          </section>
        </div>
