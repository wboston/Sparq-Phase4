<?php

/**
 * LICENSE: ##LICENSE##.
 */

/**
 * Schema Migration.
 */
class ComTopicsSchemaMigration3 extends ComMigratorMigrationVersion
{
    /**
     * Called when migrating up.
     */
    public function up()
    {
        /*
        $timeThen = microtime(true);

        $db = KService::get('anahita:database');

        dboutput("Updating Topics. This may take a while ...\n");

        //Use p tags instead of inlines for topics
        $entities = dbfetch('SELECT id, body FROM `#__nodes` WHERE type LIKE "%com:topics.domain.entity.topic" ');

        foreach ($entities as $entity) {
            $id = $entity['id'];

            $entity['body'] = strip_tags($entity['body'], '<i><b><h1><h2><h3><h4><ul><ol><li><blockquote><pre>');

            $body = preg_replace('/\n(\s*\n)+/', "</p>\n<p>", $entity['body']);
            $body = '<p>'.$body.'</p>';

            $db->update('nodes', array('body' => $body), ' WHERE id='.$id);
        }

        dboutput("Topics updated!\n");

        $timeDiff = microtime(true) - $timeThen;
        dboutput("TIME: ($timeDiff)"."\n");
        */
    }

    /**
     * Called when rolling back a migration.
     */
    public function down()
    {
        //add your migration here
    }
}
