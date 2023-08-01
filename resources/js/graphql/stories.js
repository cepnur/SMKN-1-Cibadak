import gql from "graphql-tag";

export const STORIES = gql`
    query allStories(
        $first: Int!
        $after: String
        $onlyFeatured: Boolean
        $filters: String
        $keywords: String
        $notin: [ID]
    ) {
        storiesOfWelcome(
            first: $first
            after: $after
            where: {
                onlyFeatured: $onlyFeatured
                filters: $filters
                keywords: $keywords
                notIn: $notin
            }
        ) {
            nodes {
                title
                content
                date
                postImage
                databaseId
                link
                title
                excerpt
                featuredImage {
                    node {
                        sourceUrl(size: LARGE)
                    }
                }
            }
            pageInfo {
                startCursor
                hasPreviousPage
                hasNextPage
                endCursor
                total
            }
        }
    }
`;
