#!/bin/sh

RELEASES=$(git log --oneline | awk '/\[autocommit\] AWS deploy/{print $1}')

cat <<EOF
Release Changelog
=================
EOF
for RELEASE in $RELEASES; do
  PREVIOUS_RELEASE=$(
    git log -1 --pretty=%H $RELEASE^ --grep='\[autocommit\] AWS deploy'
  )
  if [ -z "$PREVIOUS_RELEASE" ]; then
    exit
  fi

  RELEASE_TIMESTAMP=$(git log -1 $RELEASE --format=%ct)
  RELEASE_TITLE=$(
    TZ=America/Los_Angeles \
    date "+%-d %B %Y %H:%M %Z (%A)" -d "@${RELEASE_TIMESTAMP}"
  )

  cat <<EOF

$RELEASE_TITLE
---

Change | Commit | Author
-------|--------|-------
EOF
  COMMIT_URL_ROOT=https://github.com/hhvm/user-documentation/commit
  FORMAT="%s | [%h]($COMMIT_URL_ROOT/%H) | %an"
  git \
    --no-pager \
    log \
    --no-merges \
    --format="$FORMAT" \
    ${PREVIOUS_RELEASE}..${RELEASE}^

  DOCKER_TAG=$(git log -1 $RELEASE --format=%s | awk '{print $NF}')
  echo "Docker image tag: \`${DOCKER_TAG}\`"
done
