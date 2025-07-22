import { Link } from "react-router-dom";

interface BlogCardProps {
  id: number;
  title: string;
  category: string;
  description: string;
  image?: string;
  slug: string;
}

export default function BlogCard({ title, slug, description }: BlogCardProps) {
  return (
    <div className="border p-4 rounded-md shadow-md hover:shadow-lg transition-shadow duration-300">
      <h3 className="text-lg font-semibold mb-2">{title}</h3>
      <p className="text-sm text-muted-foreground mb-2 line-clamp-2">{description}</p>
      <Link
        to={`/blog/${slug}`}
        className="text-blue-600 underline hover:text-blue-800 transition-colors"
      >
        Read More
      </Link>
    </div>
  );
}
