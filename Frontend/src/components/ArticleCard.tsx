import { Link } from "react-router-dom";

interface ArticleCardProps {
  id: number;
  title: string;
  slug: string;
  content: string;
}

export default function ArticleCard({ title, slug, content }: ArticleCardProps) {
  return (
    <div className="border p-4 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
      <h3 className="text-lg font-semibold mb-2">{title}</h3>
      <p className="text-sm text-muted-foreground mb-2 line-clamp-2">
        {content.slice(0, 100)}...
      </p>
      <Link
        to={`/article/${slug}`}
        className="text-blue-600 underline hover:text-blue-800 transition-colors"
      >
        Read More
      </Link>
    </div>
  );
}
