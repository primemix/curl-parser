<?php

namespace Parser;

interface ParserInterface
{
    /**
     * @return string Html Dom Document
     */
    public function getDomDocument();

    /**
     * @return boolean Response from remote server (true | false)
     */
    public function getResponseFromRemoteServer();

    /**
     * @return integer count result
     */
    public function countResult();
}