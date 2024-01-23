<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122140340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE news_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        /*$this->addSql('ALTER TABLE news_media DROP CONSTRAINT news_media_new_id_fkey');
        $this->addSql('ALTER TABLE news_media DROP CONSTRAINT news_media_media_id_fkey');
        $this->addSql('ALTER TABLE news_tags DROP CONSTRAINT news_tags_new_id_fkey');
        $this->addSql('ALTER TABLE news_tags DROP CONSTRAINT news_tags_tag_id_fkey');
        $this->addSql('DROP TABLE schema_migrations');
        $this->addSql('DROP TABLE news_media');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE news_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP INDEX news_title_idx');
        $this->addSql('DROP INDEX news_text_idx');
        $this->addSql('ALTER TABLE news ALTER id TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE news ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE news ALTER title TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE news ALTER text TYPE BYTEA');
        $this->addSql('ALTER TABLE news ALTER created_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE news ALTER created_at DROP DEFAULT');
        $this->addSql('ALTER TABLE news ALTER updated_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE news ALTER updated_at DROP DEFAULT');
        $this->addSql('ALTER TABLE news ALTER accepted_by TYPE UUID');
        $this->addSql('ALTER TABLE news ALTER created_by TYPE UUID');
        $this->addSql('ALTER TABLE news ALTER created_by SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN news.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN news.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN news.accepted_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN news.created_by IS \'(DC2Type:uuid)\'');*/
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE news_id_seq CASCADE');
        $this->addSql('CREATE TABLE schema_migrations (version BIGINT NOT NULL, dirty BOOLEAN NOT NULL, PRIMARY KEY(version))');
        $this->addSql('CREATE TABLE news_media (new_id UUID NOT NULL, media_id UUID NOT NULL, PRIMARY KEY(new_id, media_id))');
        $this->addSql('CREATE INDEX IDX_10932652BD06B3B3 ON news_media (new_id)');
        $this->addSql('CREATE INDEX IDX_10932652EA9FDD75 ON news_media (media_id)');
        $this->addSql('CREATE TABLE media (id UUID DEFAULT \'gen_random_uuid()\' NOT NULL, name VARCHAR(200) NOT NULL, path VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE news_tags (new_id UUID NOT NULL, tag_id UUID NOT NULL, PRIMARY KEY(new_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_BA6162ADBD06B3B3 ON news_tags (new_id)');
        $this->addSql('CREATE INDEX IDX_BA6162ADBAD26311 ON news_tags (tag_id)');
        $this->addSql('CREATE TABLE tags (id UUID DEFAULT \'gen_random_uuid()\' NOT NULL, text VARCHAR(200) NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX tags_text_idx ON tags (text)');
        $this->addSql('ALTER TABLE news_media ADD CONSTRAINT news_media_new_id_fkey FOREIGN KEY (new_id) REFERENCES news (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE news_media ADD CONSTRAINT news_media_media_id_fkey FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE news_tags ADD CONSTRAINT news_tags_new_id_fkey FOREIGN KEY (new_id) REFERENCES news (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE news_tags ADD CONSTRAINT news_tags_tag_id_fkey FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE news ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE news ALTER id SET DEFAULT \'gen_random_uuid()\'');
        $this->addSql('ALTER TABLE news ALTER title TYPE VARCHAR(200)');
        $this->addSql('ALTER TABLE news ALTER text TYPE TEXT');
        $this->addSql('ALTER TABLE news ALTER created_at TYPE TIMESTAMP(0) WITH TIME ZONE');
        $this->addSql('ALTER TABLE news ALTER created_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE news ALTER updated_at TYPE TIMESTAMP(0) WITH TIME ZONE');
        $this->addSql('ALTER TABLE news ALTER updated_at SET DEFAULT \'now()\'');
        $this->addSql('ALTER TABLE news ALTER accepted_by TYPE UUID');
        $this->addSql('ALTER TABLE news ALTER created_by TYPE UUID');
        $this->addSql('ALTER TABLE news ALTER created_by DROP NOT NULL');
        $this->addSql('COMMENT ON COLUMN news.created_at IS NULL');
        $this->addSql('COMMENT ON COLUMN news.updated_at IS NULL');
        $this->addSql('COMMENT ON COLUMN news.accepted_by IS NULL');
        $this->addSql('COMMENT ON COLUMN news.created_by IS NULL');
        $this->addSql('CREATE INDEX news_title_idx ON news (title)');
        $this->addSql('CREATE INDEX news_text_idx ON news (text)');
    }
}
