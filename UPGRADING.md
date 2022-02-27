# Upgrading

## From v1 to v2

In v1, the package handled exceptions that occured during the creation of HATEOAS links and returned an empty array of links in case an exception occured. In v2, this is not the case anymore. Every exception will be thrown.
